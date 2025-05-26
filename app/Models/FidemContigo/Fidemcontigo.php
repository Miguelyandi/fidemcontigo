<?php

namespace App\Models\FidemContigo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fidemcontigo extends Model
{
     use HasFactory;

    protected $table = 'fidemcontigos';

    protected $fillable = [
        'tipdocum', 'numdocum', 'numhistoria', 'apellido1', 'apellido2',
        'nombre1', 'nombre2', 'entidad_salud', 'telefono', 'telefono_avi',
        'telefono_residencia', 'telefono_movil', 'estado',
        'fecha_ultima_evolucion', 'eva',
    ];

    public function evoluciones()
    {
        return $this->hasMany(Evolucion::class);
    }

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class);
    }

    public function ingresoegresos()
    {
        return $this->hasMany(Ingresoegreso::class);
    }
}
