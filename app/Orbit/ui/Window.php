<?php

namespace App\Orbit\ui;

use App\Orbit\core\Exceptions\NullPointerException;
use App\Orbit\ui\dashboard\widget\TopWidget;
use Closure;
use Exception;
use Illuminate\Support\Facades\View;

abstract class Window
{

    protected static ?self $instance = null;

    protected static ?array $items = null;

    protected Closure|View|string|null $view = null;
    protected ?string $lw = null;
    protected string $handler;
    protected string $title = "";
    protected string $icon = "";
    protected ?int $badge = null;
    public ?int $priority = null;

    public function __construct(string|self $handler)
    {
        if ($handler instanceof Window) {
            $this->setHandler($handler->getHandler());
            $this->setTitle($handler->getTitle());
            $this->setBadge($handler->getBadge());
            $this->setIcon($handler->getIcon());
            $this->priority = $handler->priority;
            $this->view($handler->getRawView());
            if ($handler->hasLivewire()) $this->livewire($handler->getLivewireComponent());

            return;
        }
        $this->setHandler($handler);
    }

    public static function create(string|Window $handler): static
    {
        if (static::class === self::class) {
            throw new Exception("Cannot instantiate abstract class Widget directly.");
        }
        return new static($handler);
    }

    /**
     * @throws NullPointerException
     */
    public static function get(string $handler): ?static
    {
        return static::getByHandler($handler);
    }

    public function setBadge(Closure|int|null $badge): static
    {
        $this->badge = $badge instanceof Closure ? $badge($this->badge) : $badge;
        return $this;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;
        return $this;
    }

    public function setIcon(string $icon): static
    {
        $this->icon = $icon;
        return $this;
    }

    abstract protected function setHandler(string $handler): void;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getIcon(): string
    {
        return $this->icon;
    }

    public function getBadge(): ?int
    {
        return $this->badge < 1 ? null : $this->badge;
    }

    public function getHandler(): string
    {
        return $this->handler;
    }

    public function view(Closure|View|string|null $view): static
    {
        $this->view = $view;
        return $this;
    }

    public function getRawView(): Closure|View|string|null
    {
        return $this->view;
    }

    public function livewire(?string $lw = null): static
    {
        $this->lw = $lw;
        return $this;
    }

    public function hasLivewire(): bool
    {
        return !is_null($this->lw);
    }

    public function getLivewireComponent(): string
    {
        return $this->lw;
    }

    public function getView(): View|Closure|string|null
    {
        $view = $this->view;
        $compact = ["menu" => $this];
        if ($view instanceof Closure) {
            $v = $view($this);
            if (method_exists($v, "with")) {
                return $v->with($compact)->render();
            }
            return $v;
        }
        if (view()->exists($view)) {
            try {
                return view($view)->with($compact)->render();
            } catch (\Throwable $e) {
                return "";
            }
        }
        return $view && method_exists($view, "with") ? $view->with($compact)->render() : $view;
    }

    /**
     * @throws NullPointerException
     */
    public static function getByHandler(string $handler): ?static
    {
        foreach (static::$items[static::class] as $menus) {
            foreach ($menus as $menu) {
                if ($menu->getHandler() === $handler) {
                    return $menu;
                }
            }
        }
        $classNames = explode("\\", static::class);
        throw new NullPointerException("{{$handler}} => This Handler doesn't belong to any " . strtolower(end($classNames)));
    }

    protected function addTo(string $className, int $priority = 10): static
    {
        $this->priority = $priority;
        if (!is_null(static::$items) && isset(static::$items[$className])) {
            foreach (static::$items[$className] as $prt => $menus) {
                foreach ($menus as $i => $menu) {
                    if ($menu->getHandler() === $this->getHandler()) {
                        unset(self::$items[$className][$prt][$i]);
                    }
                }
            }
        }
        static::$items[$className][$priority][$this->getHandler()] = $this;
        return $this;
    }

    public function add(int $priority = 10): static
    {
        return $this->addTo(static::class, $priority);
    }

    public function remove(?string $from = null): static
    {
        if (is_null($from)) $from = static::class;
        unset(static::$items[$from][$this->priority][$this->getHandler()]);
        return $this;
    }

    public static function flush()
    {
        foreach (static::$items[static::class] as $priority => $menus) {
            static::$items[static::class][$priority] = [];
        }
    }

    public function appendTo(string|Window $window, ?int $priority = 10): static
    {
        $this->addTo($window instanceof Window ? $window::class : $window, $priority);
        return $this;
    }

    /**
     * @return static[]
     */
    public static function getAll(): array
    {
        if (!isset(static::$items[static::class]) || !is_array(static::$items[static::class])) return [];
        ksort(static::$items[static::class]);
        /*return self::$menus[static::class];*/
        $mWindow = [];
        if (isset(static::$items[static::class])) {
            foreach (static::$items[static::class] as $menus) {
                foreach ($menus as $menu) {
                    $mWindow[$menu->getHandler()] = $menu;
                }
            }
        }
        return $mWindow;
    }

    public static function render(): string
    {
        $out = "";
        foreach (static::getAll() as $window) {
            $out .= $window->getView();
        }
        return $out;
    }

    /*public function __toString(): string
    {

    }*/

    public function toArray(): array
    {
        return [
            "title" => $this->getTitle(),
            "icon" => $this->getIcon(),
            "badge" => $this->getBadge(),
        ];
    }

    public static function all()
    {
        print_r(Window::$items[TopWidget::class]);
    }

}
