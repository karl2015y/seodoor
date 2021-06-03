<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Door extends Model
{
    use HasFactory;
     /**
     * 管理所有參數的寫入權限(黑名單)
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 取得該門戶的廠商
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    /**
     * 取得該任門戶的所有Logs
     */
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

}
