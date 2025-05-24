<?php

namespace App\Http\Controllers\Paliativos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\carbon;
use App\Models\FidemContigo;
// use App\Models\Paliativos\fidemcontigo\observacionesfidemcontigo;


class FidemContigoController extends Controller
{

    //Metodo para guardar los datos
    public function store(Request $request)
    {


        // dd($request->all());
        $request->validate([
            'documento' => 'required|string',
            'evo' => 'required|integer',
            'fecha' => 'required|date',
            'historia' => 'required|date',
            'apertura' => 'required|string',
            'cuestionario' => 'nullable|string',
            'respuesta' => 'required|integer',
            'profesional' => 'required|string',
            'apellido' => 'required|string',
            'apellid' => 'nullable|string',
            'nombre' => 'required|string',
            'nombr' => 'nullable|string',
            'eps' => 'required|string',
            'tel' => 'required|string|max:20',
            'pertinencia' => 'required|in:si,no',
            'medicamentos' => 'required|in:si,no',
            'nombreMedicamento' => 'nullable|string',
            'observacion' => 'nullable|string',
        ]);

        Fidemcontigo::create([
            // dd($request->documento()),
            'documento' => $request->documento,
            'evo' => $request->evo,
            'fecha' => $request->fecha,
            'historia' => $request->historia,
            'apertura' => $request->apertura,
            'cuestionario' => $request->cuestionario,
            'respuesta' => $request->respuesta,
            'profesional' => $request->profesional,
            'apellido' => $request->apellido,
            'apellid' => $request->apellid,
            'nombre' => $request->nombre,
            'nombr' => $request->nombr,
            'eps' => $request->eps,
            'tel' => $request->tel,
            'pertinencia' => $request->pertinencia,
            'medicamentos' => $request->medicamentos,
            'nombreMedicamento' => $request->nombreMedicamento,
            'observacion' => $request->observacion,
        ]);

        return redirect()->back()->with('success', 'Datos guardados correctamente.');
    }

    // Método para mostrar la vista principal con datos desde SQL Server
public function index()
{
    $datos = DB::connection('local_sql')
        ->table('his_m_evolucion AS he')
        ->leftJoin('his_m_apertura AS ha', 'ha.ID_APERTURA', '=', 'he.ID_APERTURA')
        ->leftJoin('fac_m_tarjetero AS ft', 'ha.HISTORIA', '=', 'ft.HISTORIA')
        ->leftJoin('gen_m_persona AS gp', 'gp.ID_PERSONA', '=', 'ft.ID_PERSONA')
        ->join('his_m_evolucion_cuestionario AS hec', 'he.ID_EVOLUCION', '=', 'hec.ID_EVOLUCION')

        ->join(DB::raw('(
            SELECT 
                dx.DOCUMENTO, 
                dx.FACTURA,
                MAX(CASE WHEN dx.diagnostico IN (\'C_PPAL\', \'P_PPAL\') THEN dx.causa ELSE NULL END) AS dx_principal,
                MAX(CASE WHEN dx.diagnostico IN (\'C_RELA\', \'P_RELA\') THEN dx.causa ELSE NULL END) AS dx_secondary
            FROM fac_m_procedimientos_dx dx
            GROUP BY dx.DOCUMENTO, dx.FACTURA
        ) AS dx1'), function($join) {
            $join->on('dx1.DOCUMENTO', '=', 'he.DOCUMENTO_FACTURA');
            $join->on('dx1.FACTURA', '=', 'he.NUMERO_FACTURA');
        })

        ->join(DB::raw('(
            SELECT 
                ft.NUMDOCUM, 
                MAX(he.FECHAHORA_EVOLUCION) AS max_fechahora
            FROM his_m_evolucion he
            LEFT JOIN his_m_apertura ha ON ha.ID_APERTURA = he.ID_APERTURA
            LEFT JOIN fac_m_tarjetero ft ON ha.HISTORIA = ft.HISTORIA
            INNER JOIN his_m_evolucion_cuestionario hec ON he.ID_EVOLUCION = hec.ID_EVOLUCION
            WHERE hec.CUESTIONARIO_RESPUESTA = \'eva\'
              AND hec.RESPUESTA > \'0\'
              AND he.FECHAHORA_EVOLUCION >= DATEADD(DAY, -45, GETDATE())
            GROUP BY ft.NUMDOCUM
        ) AS ultimas'), function($join) {
            $join->on('ultimas.NUMDOCUM', '=', 'ft.NUMDOCUM');
            $join->on('ultimas.max_fechahora', '=', 'he.FECHAHORA_EVOLUCION');
        })

        ->select([
            DB::raw('ft.NUMDOCUM AS numdocum'),
            DB::raw('ha.HISTORIA AS numhistoria'),
            DB::raw('he.ID_EVOLUCION'),
            DB::raw('ha.FECHA_APERTURA AS fechahora_apertura'),
            DB::raw('he.FECHAHORA_EVOLUCION AS fechahora_evolucion'),
            DB::raw('hec.CUESTIONARIO AS cuestionario'),
            DB::raw('hec.RESPUESTA AS respuesta'),
            DB::raw('he.CODIGO_USUARIO AS codigo_profesional'),
            DB::raw('ft.APELLIDO1'),
            DB::raw('ft.APELLIDO2'),
            DB::raw('ft.NOMBRE1'),
            DB::raw('ft.NOMBRE2'),
            DB::raw('ft.EMPRESA AS Entidad_salud'),
            DB::raw('ft.TELEFRES AS Telefono'),
            DB::raw('ft.AVISAR_TEL AS Telefono_avi'),
            DB::raw('gp.TELEFONO_RESIDENCIA'),
            DB::raw('gp.TELEFONO_MOVIL'),
            DB::raw('dx1.dx_principal'),
            DB::raw('dx1.dx_secondary')
        ])
        ->where('hec.CUESTIONARIO_RESPUESTA', '=', 'eva')
        ->where('hec.RESPUESTA', '>', 0)
        ->whereRaw('he.FECHAHORA_EVOLUCION >= DATEADD(DAY, -45, GETDATE())')
        ->orderBy('ft.NUMDOCUM')
        ->get();

    return view('paliativos.fidemcontigo.index', compact('datos'));
}


    



    
    //Método para mostrar las observaciones con blade
    public function observaciones()
    {
        $registros = Fidemcontigo::all(); // Consulta todos los registros
        return view('paliativos.fidemcontigo.index', compact('registros')); // Llama a la vista

    }



   public function buscarPaciente($documento)
{
    $paciente = DB::table('fidemcontigo')->where('documento', $documento)->first();

    if ($paciente) {
        return response()->json($paciente);
    } else {
        return response()->json(['mensaje' => 'Paciente no encontrado'], 404);
    }
}






    

    // Método para mostrar la vista del analista
    public function indexAnalista()
    {
        return view('paliativos.fidemcontigo.indexAnalista');
    }

    // Método para mostrar la vista de consulta
    public function indexConsulta()
    {
        return view('paliativos.fidemcontigo.indexConsulta');
    }

    // Método para mostrar la vista del informe
    public function indexInforme()
    {
        return view('paliativos.fidemcontigo.indexInforme');
    }

    public function mostrarModal()
    {
        $datos = Modelo::all();

        return view('paliativos.fidemcontigo.modal.modalfidemcontigo', compact('datos'));
    }

    public function index1(Request $request)
    {

 

        if ($request->ajax()) {
            
            
      $rol_id = $request->session()->get('rol_id');
      
       $user = $request->session()->get('usuario');
     
       if($rol_id == 1 || $rol_id == 2) {

        if ($request->state != '' ||  $request->profesional != '' ||$request->future1 != '' || $request->estado_pac != '') {


            $estadomax =  DB::table('estados')
            ->select(DB::raw('MAX(id_estado) as last_id_estado'))
            ->groupBy('documento');

        $estadomaxc = DB::table('estados')
            ->rightJoinSub($estadomax, 'last_ids', function ($join) {
                $join->on('estados.id_estado', '=', 'last_ids.last_id_estado');
            });
    
         $datas = DB::table('bdpaliativos')
            ->leftJoinSub($estadomaxc, 'last_ids2', function ($join) {
                $join->on('bdpaliativos.document', '=', 'last_ids2.documento');
            })
            ->selectRaw('bdpaliativos.*, last_ids2.*, TIMESTAMPDIFF(YEAR, bdpaliativos.date_birth, now()) as edad')
            ->orderBy('bdpaliativos.state');
    
    
    if($request->state != ''){

       $datas->where('bdpaliativos.state',$request->state);

    }
    
    if($request->profesional != ''){

       $datas->where('bdpaliativos.profesional',$request->profesional);

    }
    
    if($request->future1 != ''){

        $datas->where('bdpaliativos.future1',$request->future1);

    }
    
    if($request->estado_pac != ''){

       $datas->where('last_ids2.estado_pac',$request->estado_pac);

    }
    
        $datas->get();
    
        return  DataTables()->of($datas)
            ->addColumn('action', function ($datas) {
                $button = '<button type="button" name="novedad" id="' . $datas->id . '" class="novedad btn btn-float btn-sm btn-success tooltipsC" title="Adicionar novedad"  ><i class="fas fa-notes-medical "></i></button>' .
                    $button = '<button type="button" name="estado" id="' . $datas->id . '" class="addestado btn btn-float btn-sm btn-warning tooltipsC" title="Adicionar estado"  ><i class="fas fa-user-check"></i></button><br>' .
                    $button = '<button type="button" name="fallecido" id="' . $datas->id . '" class="addfallecido btn btn-float btn-sm btn-danger tooltipsC" title="Adicionar fallecido"  ><i class="fas fa-bible"></i></button>' .
                    $button = '<button type="button" name="asociarpro" id="' . $datas->id . '" class="asociarpro btn btn-float btn-sm btn-info tooltipsC" title="Asociar a profesional"  ><i class="fas fa-clinic-medical"></i></button>'
                    //$button = '<button type="button" name="editarpaciente" id="' . $datas->id . '" class="editarpaciente btn btn-float btn-sm btn-dark tooltipsC" title="Editar Paciente"  ><i class="fas fa-edit"></i></button>'
                    // . $button = '<button type="button" name="seguimiento" class="seguimientoadd btn btn-app bg-danger tooltipsC" title="Add seguimiento" value="' . $datas->id . '" ><span class="badge bg-teal">Seguimiento</span><i class="fas fa-laptop-medical"></i> Seguimiento </button>'
                ;

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

            }else{


            $estadomax =  DB::table('estados')
            ->select(DB::raw('MAX(id_estado) as last_id_estado'))
            ->groupBy('documento');

        $estadomaxc = DB::table('estados')
            ->rightJoinSub($estadomax, 'last_ids', function ($join) {
                $join->on('estados.id_estado', '=', 'last_ids.last_id_estado');
            });



        $datas = DB::table('bdpaliativos')
            ->leftJoinSub($estadomaxc, 'last_ids2', function ($join) {
                $join->on('bdpaliativos.document', '=', 'last_ids2.documento');
            })->selectRaw('bdpaliativos.*, last_ids2.*, TIMESTAMPDIFF(YEAR, bdpaliativos.date_birth, now()) as edad')->orderBy('bdpaliativos.state')->get();


        return  DataTables()->of($datas)
            ->addColumn('action', function ($datas) {
                $button = '<button type="button" name="novedad" id="' . $datas->id . '" class="novedad btn btn-float btn-sm btn-success tooltipsC" title="Adicionar novedad"  ><i class="fas fa-notes-medical "></i></button>' .
                    $button = '<button type="button" name="estado" id="' . $datas->id . '" class="addestado btn btn-float btn-sm btn-warning tooltipsC" title="Adicionar estado"  ><i class="fas fa-user-check"></i></button><br>' .
                    $button = '<button type="button" name="fallecido" id="' . $datas->id . '" class="addfallecido btn btn-float btn-sm btn-danger tooltipsC" title="Adicionar fallecido"  ><i class="fas fa-bible"></i></button>' .
                    $button = '<button type="button" name="asociarpro" id="' . $datas->id . '" class="asociarpro btn btn-float btn-sm btn-info tooltipsC" title="Asociar a profesional"  ><i class="fas fa-clinic-medical"></i></button>'
                    //$button = '<button type="button" name="editarpaciente" id="' . $datas->id . '" class="editarpaciente btn btn-float btn-sm btn-dark tooltipsC" title="Editar Paciente"  ><i class="fas fa-edit"></i></button>'
                    // . $button = '<button type="button" name="seguimiento" class="seguimientoadd btn btn-app bg-danger tooltipsC" title="Add seguimiento" value="' . $datas->id . '" ><span class="badge bg-teal">Seguimiento</span><i class="fas fa-laptop-medical"></i> Seguimiento </button>'
                ;

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);


            }
            
       }else if($rol_id == 3) {
           
           if ($request->state != '' ||  $request->profesional != '' ||$request->future1 != '' || $request->estado_pac != '') {


            $estadomax =  DB::table('estados')
            ->select(DB::raw('MAX(id_estado) as last_id_estado'))
            ->groupBy('documento');

        $estadomaxc = DB::table('estados')
            ->rightJoinSub($estadomax, 'last_ids', function ($join) {
                $join->on('estados.id_estado', '=', 'last_ids.last_id_estado');
            });
    
         $datas = DB::table('bdpaliativos')
            ->leftJoinSub($estadomaxc, 'last_ids2', function ($join) {
                $join->on('bdpaliativos.document', '=', 'last_ids2.documento');
            })
            ->selectRaw('bdpaliativos.*, last_ids2.*, TIMESTAMPDIFF(YEAR, bdpaliativos.date_birth, now()) as edad')
            ->orderBy('bdpaliativos.state');
    
    
    if($request->state != ''){

       $datas->where('bdpaliativos.state',$request->state);

    }
    
    if($request->profesional != ''){

       $datas->where('bdpaliativos.profesional',$request->profesional);

    }
    
    if($request->future1 != ''){

        $datas->where('bdpaliativos.future1',$request->future1);

    }
    
    if($request->estado_pac != ''){

       $datas->where('last_ids2.estado_pac',$request->estado_pac);

    }
    
        $datas->get();


        return  DataTables()->of($datas)
            ->addColumn('action', function ($datas) {
                    $button = '<button type="button" name="novedad" id="' . $datas->id . '" class="novedad btn btn-float btn-sm btn-success tooltipsC" title="Adicionar novedad"  ><i class="fas fa-notes-medical "></i></button>' .
                    $button = '<button type="button" name="estado" id="' . $datas->id . '" class="addestado btn btn-float btn-sm btn-warning tooltipsC" title="Adicionar estado"  ><i class="fas fa-user-check"></i></button><br>' .
                    $button = '<div id="ocultarid"><button type="button" name="asociarpro" id="' . $datas->id . '" class="asociarpro btn btn-float btn-sm btn-info tooltipsC" title="Asociar a profesional"  ><i class="fas fa-clinic-medical"></i></button></div>'
                    // . $button = '<button type="button" name="agendar" class="agenda btn btn-app bg-warning tooltipsC" title="Clic para agendar" value="' . $datas->id . '" ><span class="badge bg-teal">Psico</span><i class="fas fa-file-medical"></i> Agendar </button>'
                    // . $button = '<button type="button" name="seguimiento" class="seguimientoadd btn btn-app bg-danger tooltipsC" title="Add seguimiento" value="' . $datas->id . '" ><span class="badge bg-teal">Seguimiento</span><i class="fas fa-laptop-medical"></i> Seguimiento </button>'
                ;

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);

            }else{


            $estadomax =  DB::table('estados')
            ->select(DB::raw('MAX(id_estado) as last_id_estado'))
            ->groupBy('documento');

        $estadomaxc = DB::table('estados')
            ->rightJoinSub($estadomax, 'last_ids', function ($join) {
                $join->on('estados.id_estado', '=', 'last_ids.last_id_estado');
            });



        $datas = DB::table('bdpaliativos')
            ->leftJoinSub($estadomaxc, 'last_ids2', function ($join) {
                $join->on('bdpaliativos.document', '=', 'last_ids2.documento');
            })
            ->selectRaw('bdpaliativos.*, last_ids2.*, TIMESTAMPDIFF(YEAR, bdpaliativos.date_birth, now()) as edad')
            ->orderBy('bdpaliativos.state')->get();


        return  DataTables()->of($datas)
            ->addColumn('action', function ($datas) {
                $button = '<button type="button" name="novedad" id="' . $datas->id . '" class="novedad btn btn-float btn-sm btn-success tooltipsC" title="Adicionar novedad"  ><i class="fas fa-notes-medical "></i></button>' .
                    $button = '<button type="button" name="estado" id="' . $datas->id . '" class="addestado btn btn-float btn-sm btn-warning tooltipsC" title="Adicionar estado"  ><i class="fas fa-user-check"></i></button><br>'.
                    $button = '<div id="ocultarid"><button type="button" name="asociarpro" id="' . $datas->id . '" class="asociarpro btn btn-float btn-sm btn-info tooltipsC" title="Asociar a profesional"  ><i class="fas fa-clinic-medical"></i></button></div>'
                   // $button = '<button type="button" name="fallecido" id="' . $datas->id . '" class="addfallecido btn btn-float btn-sm btn-danger tooltipsC" title="Adicionar fallecido"  ><i class="fas fa-bible"></i></button>' .
                    //$button = '<button type="button" name="asociarpro" id="' . $datas->id . '" class="asociarpro btn btn-float btn-sm btn-info tooltipsC" title="Asociar a profesional"  ><i class="fas fa-clinic-medical"></i></button>'
                    // . $button = '<button type="button" name="agendar" class="agenda btn btn-app bg-warning tooltipsC" title="Clic para agendar" value="' . $datas->id . '" ><span class="badge bg-teal">Psico</span><i class="fas fa-file-medical"></i> Agendar </button>'
                    // . $button = '<button type="button" name="seguimiento" class="seguimientoadd btn btn-app bg-danger tooltipsC" title="Add seguimiento" value="' . $datas->id . '" ><span class="badge bg-teal">Seguimiento</span><i class="fas fa-laptop-medical"></i> Seguimiento </button>'
                ;

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);


            }
           
           
           

        }
        
        }


        return view('paliativos.index');
    }




}
