<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, Softdeletes;

    protected $table = 'tasks';

    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'end_date'
    ];
}
