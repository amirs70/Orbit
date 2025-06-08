<?php

namespace App\Orbit\ui\livewire\dashboard;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;


class AllWidget extends Component
{

    public int $user_id;

    public function mount(): void
    {
        $this->user_id = request()->family->id;
    }

    #[On("dashboard.widget_changed_from_top")]
    public function render(): View
    {
        return view("orbit::v1.Dashboard.widgets.all_widgets");
    }

}
