<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $casts =[
        'TicketDate' => 'datetime',
    ];
    public function Contacts()
    {
        return $this->belongsTo(Contacts::class ,'ContactId');
    }

    public function TicketStatus()
    {
        return $this->belongsTo(TicketStatus::class ,'StatusId');
    }
    public function TicketTypes()
    {
        return $this->belongsTo(TicketTypes::class ,'TypeId');
    }
    public function VisaTypes()
    {
        return $this->belongsTo(VisaTypes::class , 'VisaTypeId');
    }


}
