<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religions extends Model
{
    use HasFactory;

    public function Workers()
    {
        return $this->hasMany(Workers::class, 'ReligionId');
    }
}
