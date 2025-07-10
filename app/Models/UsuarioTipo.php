<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioTipo extends Model
{
      use HasFactory;
      protected $fillable = ['nome'];

      protected $table = 'usuario_tipos';
}
