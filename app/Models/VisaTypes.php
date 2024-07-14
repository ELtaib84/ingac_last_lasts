<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaTypes extends Model
{
    use HasFactory;

    public function Tickets()
    {
         return $this->hasMany(Tickets::class);

    }
    public function Contracts()
    {
        return $this->hasMany(Contracts::class, 'VisaTypeId');
    }
}
