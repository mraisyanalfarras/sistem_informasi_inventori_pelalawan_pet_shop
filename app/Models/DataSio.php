<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSio extends Model
{
    use HasFactory;

    protected $table = 'data_sios';

    // Kolom yang dapat diisi
    protected $fillable = [
        'user_id',
        'nik',
        'name',
        'position',
        'no_sio',
        'type_sio',
        'class',
        'expire_date',
        'status',
        'reminder',
        'location',
        'foto',
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function reminder()
{
    return $this->morphOne(Reminder::class, 'remindable');
}

}
