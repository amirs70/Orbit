<?php

namespace App\Orbit;

use App\Orbit\core\TokenMaker;
use App\Orbit\core\TokenMakers\HashTokenMaker;
use File;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class OrbitServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        TokenMaker::setMaker(HashTokenMaker::class);
    }

    private function camelCaseToSnakeCase(string $string): string
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
    }

    private function registerLivewires()
    {
        $baseNamespace = 'App\\Orbit\\ui\\livewire\\';
        $basePath = str_replace("\\", '/', app_path('Orbit/ui/livewire'));

        if (File::exists($basePath)) {
            foreach (File::allFiles($basePath) as $file) {
                $relativePath = str_replace([$basePath . '/', '.php'], '', $file->getRealPath());
                $relativePath = str_replace("\\", '/', $relativePath);
                $relativePath = str_replace($basePath . "/", '', $relativePath);
                $className = (str_replace('/', '\\', $relativePath));
                $fullClass = $baseNamespace . $className;

                if (class_exists($fullClass)) {
                    $x = explode("\\", $className);
                    $className = str_replace(end($x), $this->camelCaseToSnakeCase(end($x)), $className);
                    $componentName = strtolower(str_replace('\\', '.', $className));
                    Livewire::component($componentName, $fullClass);
                }
            }
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //dd( Chats::class);
        $this->registerLivewires();
        require_once __DIR__ . "/core/helpers/functions.php";
        $routes = scandir(__DIR__ . "/Routes");
        unset($routes[0], $routes[1]);
        foreach ($routes as $route) {
            $this->loadRoutesFrom(__DIR__ . "/Routes/" . $route);
        }
        $this->loadMigrationsFrom(__DIR__ . "/Migrations");
        $this->loadViewsFrom(__DIR__ . "/Views", "orbit");
    }
}
