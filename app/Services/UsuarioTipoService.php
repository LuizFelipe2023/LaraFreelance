<?php

namespace App\Services;
use App\Models\UsuarioTipo;

class UsuarioTipoService
{
      public function getAllUsuariosTipo()
      {
             return UsuarioTipo::all();
      }
}