<?php

namespace App\Orbit\Controllers;

use App\Http\Controllers\Controller;
use App\Orbit\core\File\Files;

class AssetController extends Controller
{
    public function resource(string $asset): void
    {
        Files::getInstance(__DIR__ . "/../public/" . str_replace("@", "/", $asset))->header();
    }
}
