<?php

namespace App\Orbit\ui\livewire\dashboard\widget\top_widget;

use App\Orbit\core\Orbit;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class Glance extends Component
{

    public int $is_dark;

    public function mount(): void
    {
        $this->is_dark = is_dark() ? 1 : 0;
    }

    public function toggle()
    {
        $this->is_dark = $this->is_dark === 1 ? 0 : 1;
        Cookie::queue(Cookie::make(Orbit::IS_DARK_NAME, is_dark() ? "0" : "1", 60 * 24 * 365));
        $this->dispatch("themeSelector.toggle", $this->is_dark);
    }

    public function render(): View
    {
        return view("orbit::v1.Dashboard.widgets.TopWidget.glance.glance");
    }

}
