<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'color_code',
        'uuid',
        'company_id',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function company()
    {
        return $this->belongsTo(CompanyModel::class);
    }
}
