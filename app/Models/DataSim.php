<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataSim extends Model
{
    use HasFactory;

    protected $table = 'data_sims'; // Menyesuaikan dengan nama tabel

    protected $fillable = [
        'user_id',
        'nik',
        'name',
        'no_sim',
        'position',
        'type_sim',
        'location',
        'expire_date',
        'reminder',
        'status',
        'foto',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function reminder()
{
    return $this->morphOne(Reminder::class, 'remindable');
}
}
