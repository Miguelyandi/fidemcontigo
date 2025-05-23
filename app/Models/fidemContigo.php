<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FidemContigo extends Model
{
    use HasFactory;

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

