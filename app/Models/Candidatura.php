<?php

// app/Models/Candidatura.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Candidatura extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trabalho_id',
        'nome',
        'email',
        'telefone',
        'endereco',
        'escolaridade',
        'experiencia',
        'formacoes',
        'mensagem',
        'anexo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trabalho()
    {
        return $this->belongsTo(Trabalho::class);
    }
}
