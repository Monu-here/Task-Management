<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function projects()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
