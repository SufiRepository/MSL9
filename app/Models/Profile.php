<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Profile extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'namapenuh',
        'user_id',
        'email',
        'no_ic',
        't_lahir',
        'jantina',
        'no_phone',
        'acc_status',
    ];

    public function getJawatan()
    {
        return $this->belongsTo('App\Models\Jawatan', 'id_jawatan', 'id_jawatan');
    }
    public function getPangkat()
    {
        return $this->belongsTo('App\Models\Pangkat', 'id_pangkat', 'id_pangkat');
    }
    public function getStatus()
    {
        return $this->belongsTo('App\Models\Status', 'id_status', 'id_status');
    }
    public function getPasukan()
    {
        return $this->belongsTo('App\Models\Pasukan', 'id_pasukan', 'id_pasukan');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logOnly(['name', 'text']);
        // Chain fluent methods for configuration options
    }
}
