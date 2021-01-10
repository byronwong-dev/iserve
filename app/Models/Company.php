<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'catch_phrase',
        'bs',
    ];

    public function users()
    {
        return $this->hasManyThrough(User::class, UserCompany::class, 'company_id', 'id', 'id', 'user_id');
    }
}
