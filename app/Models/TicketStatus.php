<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    use HasFactory;

    public function Tickets()
    {
         return $this->hasMany(Tickets::class , 'StatusId');

    }


}
