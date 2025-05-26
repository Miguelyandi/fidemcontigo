<?php

namespace App\Http\Controllers\Paliativos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\carbon;
use App\Models\FidemContigo\Fidemcontigo;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportEva;
use App\Imports\ImportMedicamentos;
// use App\Models\Paliativos\fidemcontigo\observacionesfidemcontigo;


class FidemContigoController extends Controller
{


     public function importeva(Request $request)
    {

   if($request->ajax()){


    $file5 = $request->file('file5');
    $file6 = $request->file('file6');

        if($file5 != null){

        $this->importaExcel($request);

        return response()->json(['mensaje' => 'ok']);

        }else if($file6 != null){

        $this->importaExcel2($request);

         return response()->json(['mensaje' => 'ok']);

        }else{

            return response()->json(['mensaje' => 'vacio']);//return redirect('admin/archivo')->with('mensaje', 'No seleccionaste ningun archivo');
        }

    }

   }


    public function importaExcel(Request $request)
    {

         // Guardo la colección en $file

       $file = $request->file('file5');

       $name=time().$file->getClientOriginalName();


        $destinationPath = public_path('importbd/');

        $file->move($destinationPath, $name);

        $path=$destinationPath.$name;

       // $import = new EstadosImport();

    Excel::import(new ImportEva, $path);

    }

    public function importaExcel2(Request $request)
    {

         // Guardo la colección en $file

       $file = $request->file('file6');

       $name=time().$file->getClientOriginalName();


        $destinationPath = public_path('importbd2/');

        $file->move($destinationPath, $name);

        $path=$destinationPath.$name;

       // $import = new EstadosImport();

    Excel::import(new ImportMedicamentos, $path);

    }





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
   
    return view('paliativos.fidemcontigo.index');
}

public function indexFidem(Request $request)
{
    // Verifica si la solicitud es AJAX
    if ($request->ajax()) {
        // Obtiene los datos de la base de datos
        $datas = Fidemcontigo::where('estado','Activo')->get();


        return  DataTables()->of($datas)
            ->addColumn('action', function ($datas) {
                $button = '<button type="button" name="novedad" id="' . $datas->id . '" class="novedad btn btn-float btn-sm btn-success tooltipsC" title="Adicionar seguimientos"  ><i class="fas fa-notes-medical "></i></button>' .
                $button = '<button type="button" name="estado" id="' . $datas->id . '" class="addestado btn btn-float btn-sm btn-warning tooltipsC" title="Ver Seguimientos"  ><i class="fas fa-user-check"></i></button><br>';

                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
       
    }

    // Si no es una solicitud AJAX, redirige a la vista principal
    //return view('paliativos.fidemcontigo.index');

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
