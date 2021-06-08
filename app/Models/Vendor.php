<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Vendor extends Model
{
    use HasFactory;
    /**
     * 管理所有參數的寫入權限(黑名單)
     *
     * @var array
     */
    protected $guarded = [];

    public function getCreatedAtAttribute($date)
    {
        if (Carbon::now() > Carbon::parse($date)->addDays(15)) {
            return Carbon::parse($date);
        }

        return Carbon::parse($date)->diffForHumans();
    }
    public function getUpdatedAtAttribute($date)
    {
        if (Carbon::now() > Carbon::parse($date)->addDays(15)) {
            return Carbon::parse($date);
        }

        return Carbon::parse($date)->diffForHumans();
    }


    /**
     * 取得該廠商當前的計畫
     */
    public function nowPlan()
    {
        return $this->hasOne(Plan::class)->latestOfMany();
    }

    /**
     * 取得該廠商的所有計畫
     */
    public function historyPlan()
    {
        return $this->hasMany(Plan::class);
    }

    /**
     * 取得該任廠商的所有門戶
     */
    public function doors()
    {
        return $this->hasMany(Door::class);
    }
}
