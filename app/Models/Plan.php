<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Plan extends Model
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
    public function getStopAtAttribute($date)
    {
        if (Carbon::now()->addDays(7) < Carbon::parse($date)) {
            return Carbon::parse($date);
        }

        return Carbon::parse($date)->diffForHumans();
    }

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
