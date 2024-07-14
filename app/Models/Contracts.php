<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    use HasFactory;

    protected $fillable = [
        'Total'
    ];

    protected $casts = [
        'ContractDate' => 'datetime',
        'VisaDate' => 'datetime',
        'ContractEndDate' => 'datetime',
        'DeliveryDate' => 'datetime',
    ];

    public function ContractTypes()
    {
        return $this->belongsTo(ContractTypes::class ,'ContractTypeId');

    }
        public function VisaTypes()
    {
        return $this->belongsTo(VisaTypes::class ,'VisaTypeId');

    }
    public function Cities()
    {
        return $this->belongsTo(Cities::class ,'CityId');

    }
    public function Cities_Delivery()
    {
        return $this->belongsTo(Cities::class ,'DeliveryCityId');

    }
    public function Contacts()
    {
        return $this->belongsTo(Contacts::class ,'ContactId');

    }
    public function Workers()
    {
        return $this->belongsTo(Workers::class ,'WorkerId');
    }
    public function OldWorker()
    {
        return $this->belongsTo(Workers::class ,'OldWorkerId');
    }
    public function User()
    {
        return $this->belongsTo(User::class ,'UserId');
    }
    public function ToCalledBy()
    {
        return $this->belongsTo(User::class ,'ToCalledBy');
    }
    public function ToDeliveredBy()
    {
        return $this->belongsTo(User::class ,'ToDeliveredBy');

    }
    public function Airports()
    {
        return $this->belongsTo(Airports::class ,'AirportId');

    }



}
