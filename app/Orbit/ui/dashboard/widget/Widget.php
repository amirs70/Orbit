<?php

namespace App\Orbit\ui\dashboard\widget;

use App\Orbit\core\Exceptions\NullPointerException;
use App\Orbit\Models\Family;
use App\Orbit\Models\RelatedOption;
use App\Orbit\ui\Window;

abstract class Widget extends Window
{

    private static array $allHandlers = [];

    private bool $hasFrame = true;
    private ?string $landedOn = null;
    private static ?array $custom = null;

    public function __construct(self|string $handler)
    {
        parent::__construct($handler);
        if ($handler instanceof Window) {
            $this->hasFrame($handler->hasFrame());
            $this->landedOn = $handler->getHandler();
        }
    }

    public function getLandedOn(): ?string
    {
        return $this->landedOn;
    }

    public function add(int $priority = 10): static
    {

        $this->landedOn = static::class;
        return parent::add($priority);
    }

    public function hasFrame(?bool $has = null): bool|static
    {
        if ($has === null) return $this->hasFrame;
        $this->hasFrame = $has;
        return $this;
    }

    protected function setHandler(string $handler): void
    {
        $this->handler = $handler;
    }

    public function moveTo(Widget|string $widget): static
    {
        $this->remove($this->landedOn)->appendTo($widget);
        $this->landedOn = $widget;
        return $this;
    }

    private static function getAllWidgetArray(): array
    {
        $widgets = [];
        foreach ([TopWidget::class, StartWidget::class, EndWidget::class] as $section) {
            $hidden = $section::$custom["hidden"] ?? [];
            $section::$custom["hidden"] = [];
            foreach (call_user_func([$section, "getAll"]) as $widget) {
                $widgets[$widget->getHandler()] = $widget->getTitle();
            }
            $section::$custom["hidden"] = $hidden;
        }
        return $widgets;
    }

    private static function getUserPreferredWidgets(int $user_id): ?array
    {
        self::$custom = RelatedOption::get(Family::class, $user_id, "dashboard.widget");
        return self::$custom ?? null;
    }

    private static function lookForWidgetLocation(string $handler): ?string
    {
        foreach ([TopWidget::class, StartWidget::class, EndWidget::class] as $location) {
            try {
                call_user_func([$location, "get"], $handler);
                return $location;
            } catch (NullPointerException $e) {
                continue;
            }
        }
        return null;
    }

    private static function getUserPreferredWidgetsArray(?array $preferred, bool $resort = false): ?array
    {
        if (is_null($preferred)) return [];
        $mPreferred = $preferred;
        unset($mPreferred["hidden"]);
        if (count($mPreferred) < 1) return [];
        $locations = ["top" => TopWidget::class, "start" => StartWidget::class, "end" => EndWidget::class];
        //$widgets = ["top" => [], "start" => [], "end" => []];
        $keyValue = [];

        foreach (["top", "start", "end"] as $type) {
            foreach ($preferred[$type] as $w) {
                $locationClass = self::lookForWidgetLocation($w);
                //echo $w . " => " . $locationClass . PHP_EOL;
                $widget = call_user_func([$locationClass, "get"], $w);
                $keyValue[$widget->getHandler()] = $widget->getTitle();
                $widget->remove($locationClass);

                call_user_func([$locations[$type], "create"], $widget)->add(5);
            }
        }
        return $keyValue;
    }

    public static function customizedSortForMe(int $user_id)
    {
        $res = self::getUserPreferredWidgets($user_id);
        $all = self::getAllWidgetArray();
        ksort($all);
        $preferred = self::getUserPreferredWidgetsArray($res, true);

        return [
            "all" => $all,
            /*"preferred" => $preferred,*/
            "hidden" => $res["hidden"] ?? [],
        ];
    }

    public static function getAll(): array
    {
        $all = parent::getAll();
        $hidden = isset(self::$custom["hidden"]) && is_array(self::$custom["hidden"]) ? self::$custom["hidden"] : [];
        if (count($all) > 0) {
            foreach ($all as $key => $widget) {
                if (in_array($key, $hidden)) {
                    unset($all[$widget->getHandler()]);
                }
            }
        }
        return $all;
    }

}
