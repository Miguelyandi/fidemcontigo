<div class="row">
    <div class="col-lg-12">
        @include('includes.form-error')
        @include('includes.form-mensaje')
    <div class="card card-info">
        <div class="card-header with-border">
          <h3 class="card-title">Fidem Contigo</h3>
          <div class="card-tools pull-right">
            <!-- <button type="button" class="btn create_evolution btn-default" name="create_evolution" id="create_evolution" ><i class="fa fa-fw fa-plus-circle"></i>Nueva evolución</button> -->
           </div>
        </div>
      <div class="card-body table-responsive p-2">

      <table id="psicologica" class="table table-hover  text-nowrap">
       
        <thead>
            <tr>
              <th>Acciones</th>
              <th>N° Documento</th>
              <th>IDEVOLUCION</th>
              <th>Fecha apertura</th>
              <th>Fecha Evolución</th>
              <th>Tipo HC</th>
              <th>Cuestionario</th>
              <th>Respuesta</th>
              <th>Profesional</th>
              <th>Primer apellido</th>
              <th>Segundo apellido</th>
              <th>Primer nombre</th>
              <th>Segundo nombre</th>
              <th>EPS</th>
              <th>Telefono</th>
          
             </tr>
        </thead>
        <tbody>

          @foreach ($datos as $dato)
                        
                        
                                                       
                            <td>
                              <button type="button" id="{{$dato->numdocum ?? ''}}" data-Acciones="{{ $dato->Acciones ?? ''}}"
                                data-documento="{{ $dato->numdocum ?? '' }}"
                                data-evo="{{ $dato->ID_EVOLUCION ?? '' }}"
                                data-fecha="{{ $dato->fechahora_apertura ?? '' }}"
                                data-historia="{{ $dato->fechahora_evolucion ?? '' }}"
                                data-apertura="{{ $dato->tipo_historia ?? '' }}"
                                data-cuestionario="{{ $dato->cuestionario ?? '' }}"
                                data-respuesta="{{ $dato->respuesta ?? '' }}"
                                data-profesional="{{ $dato->codigo_profesional ?? '' }}"
                                data-apellido="{{ $dato->APELLIDO1 ?? '' }}"
                                data-apellid="{{ $dato->APELLIDO2 ?? '' }}"
                                data-nombre="{{ $dato->NOMBRE1 ?? '' }}"
                                data-nombr="{{ $dato->NOMBRE2 ?? '' }}"
                                data-eps="{{ $dato->Entidad_salud ?? '' }}"
                                data-tel="{{ $dato->Telefono ?? '' }}"
                               name="Editar" title="Evolución" class = "evolucion btn-float  bg-gradient-warning btn-sm tooltipsC"><i class="fa fa-fw fa-plus-circle"></i></i></a>
                              </button>

                            <button type="button" id="{{$dato->numdocum ?? ''}}"
                                    data-acciones="{{ $dato->Acciones ?? '' }}"
                                    data-documento="{{ $dato->numdocum ?? '' }}"
                                    data-evo="{{ $dato->ID_EVOLUCION ?? '' }}"
                                    data-fecha="{{ $dato->fechahora_apertura ?? '' }}"
                                    data-historia="{{ $dato->fechahora_evolucion ?? '' }}"
                                    data-apertura="{{ $dato->tipo_historia ?? '' }}"
                                    data-cuestionario="{{ $dato->cuestionario ?? '' }}"
                                    data-respuesta="{{ $dato->respuesta ?? '' }}"
                                    data-profesional="{{ $dato->codigo_profesional ?? '' }}"
                                    data-apellido="{{ $dato->APELLIDO1 ?? '' }}"
                                    data-apellid="{{ $dato->APELLIDO2 ?? '' }}"
                                    data-nombre="{{ $dato->NOMBRE1 ?? '' }}"
                                    data-nombr="{{ $dato->NOMBRE2 ?? '' }}"
                                    data-eps="{{ $dato->Entidad_salud ?? '' }}"
                                    data-tel="{{ $dato->Telefono ?? '' }}"
                                    title="Observación"
                                    class="observacion btn btn-warning btn-sm">
                                <i class="fa fa-eye"></i>
                            </button>

                             

                            </td>
                                                                                
                            <!-- <td>{{$dato->Acciones ?? ''}}</td> -->
                            <td> {{$dato->numdocum ?? ''}}</td>
                            <td> {{$dato->ID_EVOLUCION ?? ''}}</td>
                            <td> {{$dato->fechahora_apertura ?? ''}}</td>
                            <td> {{$dato->fechahora_evolucion ?? ''}}</td>
                            <td> {{$dato->tipo_historia ?? ''}}</td>
                            <td> {{$dato->cuestionario ?? ''}}</td>
                            <td> {{$dato->respuesta ?? ''}}</td>
                            <td> {{$dato->codigo_profesional ?? ''}}</td>
                            <td> {{$dato->APELLIDO1 ?? ''}}</td>
                            <td> {{$dato->APELLIDO2 ?? ''}}</td>
                            <td> {{$dato->NOMBRE1 ?? ''}}</td>
                            <td> {{$dato->NOMBRE2 ?? ''}}</td>
                            <td> {{$dato->Entidad_salud ?? ''}}</td> 
                            <td> {{$dato->Telefono ?? ''}}</td>                                            
                        </tr>
                       
          @endforeach


        </tbody>
      </table>
    </div>
  </form>
    <!-- /.card-body -->
</div>
</div>
</div>
