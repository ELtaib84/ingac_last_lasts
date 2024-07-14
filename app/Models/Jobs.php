<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    protected $fillable = [
        'Name'
    ];

    public function Workers()
    {
        return $this->hasMany(Workers::class, 'JobId');
    }
}
