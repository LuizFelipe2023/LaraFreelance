<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
      protected $fillable = ['titulo','corpo','user_id','candidatura_id'];

      protected $table = 'mensagens';
}
