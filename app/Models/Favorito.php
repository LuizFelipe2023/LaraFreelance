<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
      protected $fillable = ['user_id','trabalho_id','candidatura_id'];

      
}
