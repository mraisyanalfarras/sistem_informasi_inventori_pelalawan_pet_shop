<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = ['remind_at', 'note'];

    public function remindable()
    {
        return $this->morphTo();
    }
}