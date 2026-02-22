<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'task_name',
        'project_id',
        'description',
        'status',
        'uuid',
    ];

    public function projects()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
