<?php

namespace App\Orbit\Controllers;

use App\Http\Controllers\Controller;
use App\Orbit\ui\livewire\dashboard\navigation\WidgetController;
use App\Orbit\ui\ParentChildMenu\NavigationMenu\Navigation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    private function basic()
    {
        Navigation::create("widgets_controller")
            ->livewire(WidgetController::class)
            ->add();
    }

    public function index(Request $request): Factory|Application|View|\Illuminate\View\View
    {

        $this->basic();

        return view("orbit::v1.dashboard.index")
            ->with("title", "Dashboard");
    }
}
