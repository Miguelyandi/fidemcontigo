<?php

namespace App\Models\Paliativos\fidemcontigo;

use App\Models\Seguridad\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacionesfidemcontigo extends Model
{
    protected $table = 'fidemcontigo';

    protected $fillable = [
        'documento',
        'evo',
        'fecha',
        'historia',
        'apertura',
        'cuestionario',
        'respuesta',
        'profesional',
        'apellido',
        'apellid',
        'nombre',
        'nombr',
        'eps',
        'tel',
        'pertinencia',
        'medicamentos',
        'nombreMedicamento',
        'observacion'
    ];

   
}