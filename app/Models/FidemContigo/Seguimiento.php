<?php

namespace App\Models\FidemContigo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
     use HasFactory;

    protected $table = 'seguimientos';

    protected $fillable = [
        'fidemcontigos_id', 'evoluciones_id', 'todos_entregados',
        'observacion_general', 'estado_contacto'
    ];

    public function fidemcontigo()
    {
        return $this->belongsTo(Fidemcontigo::class);
    }

    public function evolucion()
    {
        return $this->belongsTo(Evolucion::class);
    }
}
