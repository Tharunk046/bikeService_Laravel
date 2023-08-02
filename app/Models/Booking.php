<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/* Model for Booking */
// foriegn key = client_id
class Booking extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'id';
    protected $fillable = ['client_id','name','email','phone','address','brand','model','reg_num','services','booking_date','status'];
}
