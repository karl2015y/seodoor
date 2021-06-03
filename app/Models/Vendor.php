<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
     /**
     * 管理所有參數的寫入權限(黑名單)
     *
     * @var array
     */
    protected $guarded = [];

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
