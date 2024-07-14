<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractTypes extends Model
{
    use HasFactory;

    public function Contracts()
    {
        return $this->hasMany(Contracts::class, 'ContractTypeId');
    }


}
