    <div class="container-fluid">
    <div class="row">
    <div class="col-md-3">

    <div class="card card-primary card-outline">
    <div class="card-body box-profile">
    <div class="text-center">
    <img class="profile-user-img img-fluid img-circle" src="{{asset("assets/$theme/dist/img/user_default.jpg  ")}}" alt="User profile picture">
    </div>

    <h2 id="namesadd" class="profile-username text-center text-muted"></h2>
    <p id="documentsadd" class="text-muted text-center"></p>
    <ul class="list-group list-group-unbordered mb-3">
    <li class="list-group-item accent-blue">
    <b  class="text-muted">Estado:</b> <a id="estado" class="float-right"></a>
    </li>
     <li class="list-group-item accent-blue">
        <b  class="text-muted">Escala de eva actual:</b> <a id="eva" class="float-right"></a>
    </li>
     <li class="list-group-item accent-blue">
    <b  class="text-muted">EPS:</b> <a id="eps" class="float-right"></a>
    </li>
    <li class="list-group-item accent-blue">
        <b  class="text-muted">Contactos:</b> <a id="celular" class="float-right"></a>
    </li>
    <li class="list-group-item accent-blue">
        <b  class="text-muted">Ultima evolución:</b> <a id="evolucion" class="float-right"></a>
    </li>
    <li class="list-group-item accent-blue">
        <b  class="text-muted">Profesional:</b> <a id="profesional" class="float-right"></a>
    </li>
    </ul>
    </div>
    </div>
    </div>

    <div class="col-md-9">
    <div class="card card-primary card-outline">
    <div class="card-header p-2">
    <ul class="nav nav-pills">
    <li class="nav-item"><a class="nav-link active" data-toggle="tab">Seguimiento</a>
    </li>
    </ul>
    </div>
    
 
    <div class="card-body">
        
         <div class="col-lg-6 col-md-12 col-xs-12 p-0 mt-3">
        <label for="seguimiento_estado" class="form-label" style="color: #000000;">Estado del seguimiento</label>
        <select id="seguimiento_estado" name="seguimiento_estado" class="form-select form-select-sm" style="font-size: 0.85rem;">
            <option value="" selected disabled>Seleccione una opción</option>
            <option value="si">Paciente atiende llamada</option>
            <option value="no">Paciente no atiende llamada</option>
        </select>
    </div>

    <div class="tab-pane active" id="activity">
        <div class="post">
            <div class="user-block">
             <span class="username">
            <a id="eva"></a>
             <a id="eps"></a>
            </span>
            <span id ="fecha" class="description"></span>
            </div>
    
       <div class="col-lg-12 col-md-12 col-xs-12 p-0 mt-3">
        <label class="form-label" style="color: #000000;">Medicamentos</label>
        <div id="medicamentos_add" class="border rounded p-2" style="background-color: #f8f9fa; font-size: 0.70rem;"></div>
    </div>
    
        <div class="col-lg-6 col-md-12 col-xs-12 p-0 mt-3">
        <label for="medicamento_entregado_todos" class="form-label" style="color: #000000;">Adherencia al tratamiento</label>
        <select id="medicamento_entregado_todos" name="medicamento_entregado_todos" class="form-select form-select-sm" style="font-size: 0.85rem;">
            <option value="" selected disabled>Seleccione una opción</option>
            <option value="si">Sí</option>
            <option value="no">No</option>
             <option value="aplica">No aplica</option>
        </select>
    </div>


        <div class="col-lg-12 col-md-12 col-xs-12 p-0">
               <textarea name="addobservacion" id="addobservacion" class="form-control UpperCase" rows="10" placeholder="Ingrese la observación ..." value="{{old('addobservacion')}}" ></textarea>
        </div>

        <input type="hidden" name="pac_id" id="pac_id" class="form-control" value="">
        <input type="hidden" name="evo_id" id="evo_id" class="form-control" value="">
        <input type="hidden" name="user_id" id="user_id" class="form-control" value="">


    </div>

    <div class="card-footer p-2">
        <button type="button" id="guardarSeguimiento" class="btn btn-primary">
    Guardar seguimiento
</button>
    </div>

    </div>





    </div>


    </div>
    </div>
    </div>
    </div>
    
    

