<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $fillable = [
        'Name'
    ];

    public function Contacts()
    {
        return $this->hasMany(Contacts::class, 'CityId');
    }
}
