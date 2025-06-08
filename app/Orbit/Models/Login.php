<?php

namespace App\Orbit\Models;

use Illuminate\Database\Eloquent\Model;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Request;

class Login extends Model
{

    protected $table = "family_logins";

    public const STATUS_PENDING = 1;
    public const STATUS_SUCCESS = 0;

    /**
     * Submit a new login
     * @return string|bool False for failure and the login hash as a string for success
     */
    public static function make(string|int $id, string $token, $package = "web"): string|bool
    {
        $login = new self();
        try {
            $login->token = $token;
            $login->ip = Request::ip();
            $login->family_id = $id;
            $login->agent = Request::header("User-Agent");
            $login->hash = sha1($login->token . $id . now());
            $login->package = $package;
            $login->status = Login::STATUS_SUCCESS;
            $login->is_active = true;
            if ($login->save()) {
                Login::where("family_id", $id)
                    ->where("token", $login->token)
                    ->where("hash", "!=", $login->hash)
                    ->delete();

                Login::where("family_id", $id)
                    ->where("hash", "!=", $login->hash)
                    ->update(["is_active" => false]);

                return $login->hash;
            }
            return false;
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface) {
            return false;
        }
    }

    public function family(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Family::class);
    }

}
