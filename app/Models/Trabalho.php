<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabalho extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descricao',
        'user_id',
        'status',
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // // Relação com candidaturas recebidas
    // public function candidaturas()
    // {
    //     return $this->hasMany(Candidatura::class);
    // }
}
