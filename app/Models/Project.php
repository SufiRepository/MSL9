<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, Softdeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'description',
        'status',
        'client_company',
        'project_leader',
        'estimated_budget',
        'spent_budget',
        'project_duration'
    ];

    /**
     * The projects that belong to the user.
     */
    public function users()
    {
        //return $this->belongsToMany(User::class, 'project_user', 'user_id', 'role_id');
        return $this->belongsToMany(User::class, 'project_user');
    }


}
