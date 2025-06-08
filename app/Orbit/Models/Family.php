<?php

namespace App\Orbit\Models;

use App\Orbit\Models\Login;
use Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Family extends Model
{

    protected $hidden = ["password"];

    protected $casts = [
        "created_at" => "timestamp",
        "updated_at" => "timestamp"
    ];

    public static function checkPass(Family $family, string $input): bool
    {
        return Hash::check($input, $family->password);
    }

    public function logins(): HasMany
    {
        return $this->hasMany(Login::class);
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . " " . $this->last_name);
    }

}
