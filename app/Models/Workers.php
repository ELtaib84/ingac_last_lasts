<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    use HasFactory;

    protected $casts = [
        'BirthDate' => 'datetime',
    ];


    public function Nationality()
    {
        return $this->belongsTo(Nationalities::class,'NationalityId');
    }
    public function ContractTypes()
    {
        return $this->belongsTo(ContractTypes::class,'NationalityId');
    }
    public function Religions()
    {
        return $this->belongsTo(Religions::class,'ReligionId');
    }
    public function Jobs()
    {
        return $this->belongsTo(Jobs::class,'JobId');
    }
    public function Agents()
    {
        return $this->belongsTo(Agents::class,'AgentId');
    }
    public function Contracts()
    {
        return $this->hasMany(Contracts::class,'WorkerId');

    }


}
