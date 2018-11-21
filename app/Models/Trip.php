<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function convertToDbDate($date)
    {
        $srbFormat = $date;

        list($day, $month, $year) = explode("-", $srbFormat);

        $dbFormat = "{$year}-{$month}-{$day}";

        return $dbFormat;
    }

    // public function paginate($items, $perPage = 15, $page = null, $options = [])
    // {
    //     $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
    //     $items = $items instanceof Collection ? $items : Collection::make($items);
    //     return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    // }

}
