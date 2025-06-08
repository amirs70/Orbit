<?php

use App\Orbit\Controllers\Ajax\Dashboard\WidgetChangeController;
use App\Orbit\core\Routes\OrbitRoute;
use Illuminate\Support\Facades\Route;

OrbitRoute::groups(routes: function () {


    Route::post("Ajax", [OrbitRoute::class, "ajax"])->name("ajax");

});

OrbitRoute::registerAjax("dashboard.widget_change", [WidgetChangeController::class, "sort"]);
OrbitRoute::registerAjax("dashboard.widget_hide_or_show", [WidgetChangeController::class, "changeHidden"]);
