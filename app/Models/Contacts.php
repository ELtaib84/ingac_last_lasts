<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    use HasFactory;

    protected $fillable =[
        'ContactTypeId',
        'Name',
        'Email',
        'Phone',
        'NationalityId',
        'IdNumber',
        'IdIssueFrom',
        'Profession',
        'BirthDate',
        'Age',
        'CityId',
        'Address',
        'Notes',
        'RelatePhone',
        'RelateName',
        'RelateEmail',
        'RelateType',
        'InsertUserId',
        'UpdateUserId',
        'BlackList',
        'StopReason'


    ];

    protected $casts = [
        'BirthDate' =>'date:Y-m-d',
    ];

    public function Nationality()
    {
        return $this->belongsTo(Nationalities::class,'NationalityId');

    }
    public function City()
    {
        return $this->belongsTo(Cities::class,'CityId');
    }
    public function ContactType()
    {
        return $this->belongsTo(ContactTypes::class,'ContactTypeId');

    }
    public function Tickets()
    {
        return $this->hasMany(Tickets::class,'ContactId');

    }
}
