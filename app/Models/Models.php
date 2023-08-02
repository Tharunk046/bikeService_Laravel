<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/* Model for model */
// foriegn key = brand_id
class Models extends Model
{
    protected $table = 'models';
    protected $primaryKey = 'id';
    protected $fillable = ['brand_id','model_name'];
}
