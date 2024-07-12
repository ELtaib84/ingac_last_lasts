<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationalities extends Model
{
    use HasFactory;
    protected $fillable = [
        'Name'
    ];

    public function Agents()
    {
        return $this->hasMany(Agents::class , 'NationalityId');
    }
    public function Contacts()
    {
        return $this->hasMany(Contacts::class, 'NationalityId');
    }
}
