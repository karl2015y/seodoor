<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
     /**
     * 管理所有參數的寫入權限(黑名單)
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 取得該計畫的類型
     */
    public function planType()
    {
        return $this->belongsTo(PlanType::class);
    }

    /**
     * 取得該計畫的廠商
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
