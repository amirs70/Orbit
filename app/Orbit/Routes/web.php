<?php

use App\Orbit\Controllers\AssetController;
use App\Orbit\Controllers\DashboardController;
use App\Orbit\Controllers\LoginController;
use App\Orbit\core\Routes\OrbitRoute;
use App\Orbit\Middlewares\OrbitAuth;
use App\Orbit\Middlewares\OrbitPermission;
use App\Orbit\ui\dashboard\widget\EndWidget;
use App\Orbit\ui\dashboard\widget\StartWidget;
use App\Orbit\ui\dashboard\widget\TopWidget;
use App\Orbit\ui\ParentChildMenu\NavigationMenu\Navigation;
use App\Orbit\ui\ParentChildMenu\NavigationMenu\NavigationChild;
use App\Orbit\ui\ParentChildMenu\SidebarMenu\Sidebar;
use App\Orbit\ui\ParentChildMenu\SidebarMenu\SidebarChild;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Support\Facades\Route;

Route::get("/Orbit/public/{asset}", [AssetController::class, "resource"])->where('asset', '(.*)');

OrbitRoute::groups(routes: function () {
    Route::get("/Dashboard", [DashboardController::class, "index"])->name("dashboard");

    Route::get("/Login", [LoginController::class, "index"])->name("login")
        ->withoutMiddleware([OrbitAuth::class, OrbitPermission::class, EncryptCookies::class]);
    Route::post("/Login", [LoginController::class, "login"])->name("login.post")
        ->withoutMiddleware([OrbitAuth::class, OrbitPermission::class, EncryptCookies::class]);

});

Sidebar::create("/Dashboard")
    ->setTitle("Dashboard")
    ->add();

Sidebar::create("/Settings")
    ->setTitle("Settings")
    ->addChild(
        SidebarChild::getInstance()
            ->setTitle("Main")
            ->setIcon('<i class="bi bi-gear"></i>')
            ->setUrl("/Settings/Main")
    )
    ->add();

Sidebar::get("/Dashboard")
    ->addChild(
        SidebarChild::getInstance()
            ->setIcon('<i class="bi bi-speedometer"></i>')
            ->setTitle("Dashboard")
            ->setUrl("/Dashboard")
    )
    ->addChild(
        SidebarChild::getInstance()
            ->setUrl(url("/"))
            ->setTitle("Website")
            ->setIcon('<i class="bi bi-house"></i>')
    )
    ->add(1);

$user1 = orbit_asset("img/user1-128x128.jpg");
$user2 = orbit_asset("img/user2-160x160.jpg");
$user3 = orbit_asset("img/user3-128x128.jpg");
$logo = orbit_asset("img/logo.png");

Navigation::create("user")
    ->setIcon("<img class='rounded-circle' width='40' style='margin-top: -7px' src='$user1' alt=''/>")
    ->view(function () {
        return view("orbit::v1.Partials.Navigations.user");
    })
    ->add(9);

Navigation::create("notification")
    ->setTitle('<i class="bi bi-chat"></i>')
    ->setBadge(10)
    ->addChild(NavigationChild::getInstance()
        ->setTitle("Messages")
        ->setIcon("<img class='rounded-circle' width='20' src='$logo' alt=''/>")
    )
    ->addChild(NavigationChild::getInstance()
        ->setTitle("Jobs")
        ->setIcon('<i class="bi bi-messenger"></i>')
    )
    ->view("orbit::v1.Partials.Navigations.notification")
    ->add();

/*Navigation::create("chats")
    ->setTitle('<i class="bi bi-chat-text"></i>')
    ->setBadge(1)
    ->addChild(NavigationChild::getInstance()
        ->setTitle("Alex")
        ->setBody("Hey, call me ASAP")
        ->setIcon("<img width='50' src='$user2' alt=''/>")
    )
    ->addChild(NavigationChild::getInstance()
        ->setBody("check your pm")
        ->setTitle("Nayla")
        ->setIcon('<i class="bi bi-messenger"></i>')
        ->setIcon("<img width='50' src='$user3' alt=''/>")
    )
    ->view(function () {
        return view("orbit::v1.Partials.Navigations.notification_with_body");
    })
    ->add();*/

Navigation::create("chats")
    ->livewire("common.navigation.chat.chats")
    ->setBadge(3)
    ->add();

Navigation::create("theme_selector")
    ->livewire("common.navigation.theme_selector")
    ->add();

/*Navigation::create("search")
    ->setTitle('<i class="bi bi-search"></i>')
    ->view(function () {
        return view("orbit::v1.Partials.Navigations.search");
    })
    ->add(1);*/

//Widget::create("A")->add();

TopWidget::create("small_glance0")
    ->setTitle("At a glance0")
    ->hasFrame(true)
    ->view("dashboard.widget.top_widget.")
    ->add();

TopWidget::create("small_glance")
    ->setTitle("At a glance")
    ->hasFrame(false)
    ->livewire("dashboard.widget.top_widget.glance")
    ->add();

StartWidget::create("small_glance2")
    ->setTitle("At a glance2")
    ->hasFrame(false)
    ->view(function () {
        return "glance 2";
    })
    ->add();

EndWidget::create("small_glance3")
    ->setTitle("At a glance3")
    ->hasFrame(true)
    ->view(function () {
        return "glance 3";
    })
    ->add();

TopWidget::create("small_glance4")
    ->setTitle("At a glance4")
    ->view("glance 4")
    ->add();

TopWidget::create("small_glance5")
    ->setTitle("At a glance5")
    ->view("glance 5")
    ->add();



/*$widget->moveTo(EndWidget::class);
$widget->moveTo(StartWidget::class);*/


//TopWidget::get("small_glance")->remove();

//Cookie::queue(Cookie::forget(Orbit::TOKEN_KEY_NAME));


