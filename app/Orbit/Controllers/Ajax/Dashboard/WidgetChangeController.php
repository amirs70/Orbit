<?php

namespace App\Orbit\Controllers\Ajax\Dashboard;

use App\Http\Controllers\Controller;
use App\Orbit\Models\Family;
use App\Orbit\Models\RelatedOption;
use Illuminate\Http\JsonResponse;
use function request;

class WidgetChangeController extends Controller
{
    public function sort(): JsonResponse
    {
        $id = request()->family->id;
        $validated = request()->validate([
            "widgets" => "array",
        ]);
        $preferred = RelatedOption::get(Family::class, $id, "dashboard.widget");
        $hidden = $preferred["hidden"] ?? [];
        $preferred = $validated["widgets"];
        $preferred["hidden"] = $hidden;
        RelatedOption::put(Family::class, request()->family->id, "dashboard.widget", $preferred);
        return response()->json([
            "success" => true,
        ]);
    }

    public function changeHidden()
    {
        $validated = request()->validate([
            "widget" => "required",
            "hidden" => "boolean",
        ]);
        $id = request()->family->id;
        $preferred = RelatedOption::get(Family::class, $id, "dashboard.widget");
        if (!isset($preferred["hidden"])) $preferred["hidden"] = [];
        if ($validated["hidden"] === true) {
            $preferred["hidden"][] = $validated["widget"];
        } else {
            foreach ($preferred["hidden"] as $key => $hidden) {
                if ($hidden === $validated["widget"]) {
                    unset($preferred["hidden"][$key]);
                    break;
                }
            }
        }

        RelatedOption::put(Family::class, request()->family->id, "dashboard.widget", $preferred);

        return response()->json($preferred);
    }
}
