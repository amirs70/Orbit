<?php

namespace App\Orbit\ui\ParentChildMenu;

use App\Orbit\ui\ParentChildMenu\NavigationMenu\NavigationChild;
use App\Orbit\ui\Window;
use Closure;
use Illuminate\Support\Facades\View;

abstract class Menu extends Window
{

    /**
     * @var MenuChild[]
     */
    protected ?array $children = null;

    abstract protected function setHandler(string $handler): void;

    /**
     * @return NavigationChild[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * @return array[]
     */
    public function getChildrenToArray(): array
    {
        if (!$this->hasChildren()) return [];
        return array_map(function ($child) {
            return $child->toArray();
        }, $this->getChildren());
    }

    public function childAt(MenuChild $child, ?int $index = null): static
    {
        if (is_null($index)) {
            $this->children[] = $child;
            return $this;
        }
        $this->children = array_merge(array_splice($this->children, 0, $index), [$child], array_slice($this->children, $index));
        return $this;
    }

    public function appendChild(MenuChild $child): static
    {
        return $this->childAt($child);
    }

    public function prependChild(MenuChild $child): static
    {
        return $this->addChild($child, 0);
    }

    public function addChild(MenuChild $child): static
    {
        return $this->appendChild($child);
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
        return method_exists($view, "with") ? $view->with($compact)->render() : $view;
    }

    public function hasChildren(): bool
    {
        return !is_null($this->children) && count($this->children) > 0;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), ["items" => $this->getChildrenToArray(),]);
    }

}
