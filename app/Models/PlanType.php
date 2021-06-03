<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    use HasFactory;
     /**
     * 管理所有參數的寫入權限(黑名單)
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 取得該類別的所有計畫
     */
    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
