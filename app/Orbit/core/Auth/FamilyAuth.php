<?php

namespace App\Orbit\core\Auth;

use App\Orbit\core\Orbit;
use App\Orbit\Models\Family;
use App\Orbit\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class FamilyAuth
{

    public static function getActiveLogin(Request $request): Login|bool
    {
        $token = Cookie::get(Orbit::TOKEN_KEY_NAME, "");
        if (is_null($token)) {
            return false;
        }
        $login = Login::where("token", $token)->where("is_active", true)->first();
        return is_null($login) ? false : $login;
    }

    public static function hasActiveLogin(Request $request): bool
    {
        return FamilyAuth::getActiveLogin($request) !== false;
    }

    public static function checkWithEmail($email, $password): bool|Family
    {
        $check = Family::where("email", $email)
            ->first();
        if (is_null($check)) {
            return false;
        }
        if (!Family::checkPass($check, $password)) {
            return false;
        }
        return $check;
    }

    public static function checkWithPhone($phone, $password): bool|Family
    {
        $check = Family::where("phone", $phone)
            ->first();
        if (is_null($check)) {
            return false;
        }
        if (!Family::checkPass($check, $password)) {
            return false;
        }
        return $check;
    }

    public static function checkEmailOrPhone($emailOrPhone, $password): bool|Family
    {
        $email_check = self::checkWithEmail($emailOrPhone, $password);
        if ($email_check === false) {
            $phone_check = self::checkWithPhone($emailOrPhone, $password);
            if ($phone_check === false) {
                return false;
            } else {
                return $phone_check;
            }
        } else {
            return $email_check;
        }
    }

    /**
     * @return bool|string False for failure and the login hash as a string for success
     */
    public static function loginWithEmail($email, $password, string $token, string $package = "web"): bool|string
    {
        $check = self::checkWithEmail($email, $password);
        if ($check === false) {
            return false;
        }
        return Login::make($check->id, $token, $package);
    }

    /**
     * @return bool|string False for failure and the login hash as a string for success
     */
    public static function loginWithPhone($phone, $password, string $token, $package = "web"): bool|string
    {
        $check = self::checkWithPhone($phone, $password);
        if ($check === false) {
            return false;
        }
        return Login::make($check->id, $token, $package);
    }

    /**
     * @return bool|string False for failure and the login hash as a string for success
     */
    public static function loginWithEmailOrPhone($emailOrPhone, $password, $token, $package = "web"): bool|string
    {
        $email_check = self::loginWithEmail($emailOrPhone, $password, $token, $package);
        if ($email_check === false) {
            $phone_check = self::loginWithPhone($emailOrPhone, $password, $token, $package);
            if ($phone_check === false) {
                return false;
            } else {
                return $phone_check;
            }
        } else {
            return $email_check;
        }
    }

}
