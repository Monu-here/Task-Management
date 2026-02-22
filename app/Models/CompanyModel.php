<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyModel extends Model
{
    protected $fillable = [
        'company_name',
        'address',
        'phone_number',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
