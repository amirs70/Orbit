<?php

namespace App\Orbit\Controllers;

use App\Http\Controllers\Controller;
use App\Orbit\core\Auth\FamilyAuth;
use App\Orbit\core\Orbit;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function index(): ResponseFactory|Response|Application|View|string
    {
        return view("orbit::v1.template.login", ["title" => "Login"]);
    }

    private function getError(): RedirectResponse
    {
        return redirect(route("orbit.login"))->with("error", "The email or phone number or password is incorrect");
    }

    public function login(Request $request): Response|View|JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            "email_or_phone" => "required|min:5",
            "password" => "required",
        ]);
        error_log(Orbit::TOKEN_KEY_NAME . " => " . request()->path() . ": " . request()->cookie(Orbit::TOKEN_KEY_NAME));
        $auth = FamilyAuth::loginWithEmailOrPhone($validated["email_or_phone"],
            $validated["password"],
            $request->cookie(Orbit::TOKEN_KEY_NAME));
        if ($auth === false) {
            return $this->getError();
        }

        return redirect($request->has("after") ? $request->get("after") : route("orbit.dashboard"));

    }
}
