<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
     /**
     * 管理所有參數的寫入權限(黑名單)
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 取得該Log的門戶
     */
    public function door()
    {
        return $this->belongsTo(Door::class);
    }

}
