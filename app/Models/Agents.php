<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agents extends Model
{
    use HasFactory;
    protected $fillable = [
        'Name'
    ];

    public function Nationalities()
    {
        return $this->belongsTo(Nationalities::class , 'NationalityId');

    }
}
