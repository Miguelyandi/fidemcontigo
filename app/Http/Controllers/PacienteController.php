<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FidemContigo; // Asegúrate de tener el modelo correspondiente

class PacienteController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'numdocum' => 'required|string',
            'id_evolucion' => 'required|string',
            'fechahora_apertura' => 'required|string',
            'fechahora_evolucion' => 'required|string',
            'tipo_historia' => 'required|string',
            'cuestionario' => 'required|string',
            'respuesta' => 'required|string',
            'codigo_profesional' => 'required|string',
            'apellido1' => 'required|string',
            'apellido2' => 'required|string',
            'nombre1' => 'required|string',
            'nombre2' => 'required|string',
            'entidad_salud' => 'required|string',
            'telefono' => 'required|string',
            'pertinencia' => 'required|string',
            'medicamentos' => 'required|string',
            'nombre_medicamento' => 'nullable|string',
            'observacion' => 'nullable|string',
        ]);

        // Crear una nueva instancia del modelo y guardar los datos
        $paciente = new FidemContigo();
        $paciente->numdocum = $validatedData['numdocum'];
        $paciente->id_evolucion = $validatedData['id_evolucion'];
        $paciente->fechahora_apertura = $validatedData['fechahora_apertura'];
        $paciente->fechahora_evolucion = $validatedData['fechahora_evolucion'];
        $paciente->tipo_historia = $validatedData['tipo_historia'];
        $paciente->cuestionario = $validatedData['cuestionario'];
        $paciente->respuesta = $validatedData['respuesta'];
        $paciente->codigo_profesional = $validatedData['codigo_profesional'];
        $paciente->apellido1 = $validatedData['apellido1'];
        $paciente->apellido2 = $validatedData['apellido2'];
        $paciente->nombre1 = $validatedData['nombre1'];
        $paciente->nombre2 = $validatedData['nombre2'];
        $paciente->entidad_salud = $validatedData['entidad_salud'];
        $paciente->telefono = $validatedData['telefono'];
        $paciente->pertinencia = $validatedData['pertinencia'];
        $paciente->medicamentos = $validatedData['medicamentos'];
        $paciente->nombre_medicamento = $validatedData['nombre_medicamento'];
        $paciente->observacion = $validatedData['observacion'];
        $paciente->save();

        // Redirigir a una página de éxito o mostrar un mensaje
        return redirect()->back()->with('success', 'Paciente guardado exitosamente.');
    }
}

