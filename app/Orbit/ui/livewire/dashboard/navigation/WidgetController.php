<?php

namespace App\Orbit\ui\livewire\dashboard\navigation;

use App\Orbit\ui\dashboard\widget\Widget;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;


class WidgetController extends Component
{

    public int $user_id;
    public array $widgetsState = [];

    public function mount(): void
    {
        $this->user_id = request()->family->id;
    }

    public function arrangeWidgetState(): void
    {
        $widgets = Widget::customizedSortForMe($this->user_id);
        if (!is_null($widgets) && !is_null($widgets["all"])) {
            foreach ($widgets["all"] as $wKey => $widget) {
                $this->widgetsState[$wKey] = ["title" => $widget, "enabled" => !in_array($wKey, $widgets["hidden"])];
            }
        }
    }

    public function render(): View
    {
        $this->arrangeWidgetState();
        $this->dispatch("dashboard.widget_checkboxes_loaded");
        return view("orbit::v1.Dashboard.navigation.widget_controller.widget_controller");
    }

}
