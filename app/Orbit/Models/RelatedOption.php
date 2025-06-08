<?php

namespace App\Orbit\Models;

use App\Orbit\Casts\ArrayOrAnyCase;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class RelatedOption extends Model
{

    protected $guarded = [];
    protected $casts = ["value" => ArrayOrAnyCase::class];
    public $timestamps = false;

    public static function get(string $related_to, int $related_id, string $name, $belong_id = null)
    {
        try {
            $model = new $related_to();
            $related_to = $model->getTable();
        } catch (Throwable $e) {
        }
        $where = [];
        $where[] = ["related_to", "=", $related_to];
        $where[] = ["related_id", "=", $related_id];
        $where[] = ["name", "=", $name];
        if (!is_null($belong_id)) $where[] = ["belong_id", "=", $belong_id];
        $res = RelatedOption::where($where)->first(["value"]);
        return $res?->value;
    }

    public static function put(string $related_to, int $related_id, string $name, $value, $belong_id = null): self
    {
        try {
            $model = new $related_to();
            $related_to = $model->getTable();
        } catch (Throwable $e) {
        }
        $where = [];
        $where["related_to"] = $related_to;
        $where["related_id"] = $related_id;
        $where["name"] = $name;
        if (!is_null($belong_id)) $where["belong_id"] = $belong_id;
        try {

            $a = RelatedOption::updateOrCreate($where, [
                "related_to" => $related_to,
                "related_id" => $related_id,
                "name" => $name,
                "belong_id" => $belong_id,
                "value" => $value
            ]);
        } catch (Throwable $e) {
            echo "error: " . $e->getMessage();
        }
        return $a;
    }

}
