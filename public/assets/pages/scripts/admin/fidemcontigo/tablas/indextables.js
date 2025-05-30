//función para traer el resumen de los widget del Detalle turnos
var Fidemcontigo_table = function(){
    return{
        fill_datatable_tabla_seguimiento: function () {
                               
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');                           
                                   
        $('#fidemcontigo_seguimiento').DataTable({
                    language: idioma_espanol,
                    processing: true,
                    lengthMenu: [ [25, 50, 100, 500, -1 ], [25, 50, 100, 500, "Mostrar Todo"] ],
                    processing: true,
                    serverSide: true,
                    aaSorting: [[ 15, "desc" ]],
                    ajax:{
                      url:"fidemcontigo_segui",
                      data:{  _token:csrfToken},
                      method: 'post'
                          },
                    columns: [
                      {data:'action',
                       orderable: false},
                      {data:'id'},
                      {data:'tipdocum'},
                      {data:'numdocum'},
                      {data:'numhistoria'},
                      {data:'apellido1'},
                      {data:'apellido2'},
                      {data:'nombre1'},
                      {data:'nombre2'},
                      {data:'entidad_salud'},
                      {data:'telefono'},
                      {data:'telefono_avi'},
                      {data:'telefono_residencia'},
                      {data:'telefono_movil'},
                      {data:'estado'},
                      {data:'fecha_ultima_evolucion'},
                      {data:'eva'},
                      {data:'created_at'}
                    ],
                    rowCallback: function(row, data) {
                  let evaValue = parseFloat(data.eva);
                  if (!isNaN(evaValue) && evaValue >= 6 && evaValue <= 9) {
                    let color = '';
                    if (evaValue < 6.75) {
                      color = '#ffe5ec';
                    } else if (evaValue < 7.5) {
                      color = '#ffc2d1';
                    } else if (evaValue < 8.25) {
                      color = '#ffb3c6';
                    } else if (evaValue < 9) {
                      color = '#ff8fab';
                    } else {
                      color = '#fb6f92';
                    }
                    $(row).css('background-color', color);
                    $(row).css('color', '#000'); // negro para buen contraste en rosas claros
                  } else {
                    $(row).css('background-color', '');
                    $(row).css('color', '');
                  }
                },
                
                     //Botones----------------------------------------------------------------------
                
                     "dom":'<"row"<"col-xs-1 form-inline"><"col-md-4 form-inline"l><"col-md-5 form-inline"f><"col-md-3 form-inline"B>>rt<"row"<"col-md-8 form-inline"i> <"col-md-4 form-inline"p>>',
                
                     buttons: [
                                  {
                
                               extend:'copyHtml5',
                               titleAttr: 'Copiar Registros',
                               title:"Control de horas",
                               className: "btn  btn-outline-primary btn-sm"
                
                
                                  },
                                  {
                
                               extend:'excelHtml5',
                               titleAttr: 'Exportar Excel',
                               title:"Control de horas",
                               className: "btn  btn-outline-success btn-sm"
                
                
                                  },
                                   {
                
                               extend:'csvHtml5',
                               titleAttr: 'Exportar csv',
                               className: "btn  btn-outline-warning btn-sm"
                
                                  },
                                  {
                
                               extend:'pdfHtml5',
                               titleAttr: 'Exportar pdf',
                               className: "btn  btn-outline-secondary btn-sm"
                
                
                                  }
                               ]
                
                
                    });
                
                            },
    fill_datatable_tabla_sincontacto: function () {
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        $('#fidemcontigo_sincontacto').DataTable({
                    language: idioma_espanol,
                    processing: true,
                    lengthMenu: [ [25, 50, 100, 500, -1 ], [25, 50, 100, 500, "Mostrar Todo"] ],
                    processing: true,
                    serverSide: true,
                    aaSorting: [[ 15, "desc" ]],
                    ajax:{
                      url:"fidemcontigo_sincon",
                      data:{ _token:csrfToken},
                      method: 'post'
                          },
                    columns: [
                      {data:'action',
                       orderable: false},
                      {data:'id'},
                      {data:'tipdocum'},
                      {data:'numdocum'},
                      {data:'numhistoria'},
                      {data:'apellido1'},
                      {data:'apellido2'},
                      {data:'nombre1'},
                      {data:'nombre2'},
                      {data:'entidad_salud'},
                      {data:'telefono'},
                      {data:'telefono_avi'},
                      {data:'telefono_residencia'},
                      {data:'telefono_movil'},
                      {data:'estado'},
                      {data:'fecha_ultima_evolucion'},
                      {data:'eva'},
                      {data:'created_at'}
                    ],
                    rowCallback: function(row, data) {
                  let evaValue = parseFloat(data.eva);
                  if (!isNaN(evaValue) && evaValue >= 6 && evaValue <= 9) {
                    let color = '';
                    if (evaValue < 6.75) {
                      color = '#ffe5ec';
                    } else if (evaValue < 7.5) {
                      color = '#ffc2d1';
                    } else if (evaValue < 8.25) {
                      color = '#ffb3c6';
                    } else if (evaValue < 9) {
                      color = '#ff8fab';
                    } else {
                      color = '#fb6f92';
                    }
                    $(row).css('background-color', color);
                    $(row).css('color', '#000'); // negro para buen contraste en rosas claros
                  } else {
                    $(row).css('background-color', '');
                    $(row).css('color', '');
                  }
                },
                
                     //Botones----------------------------------------------------------------------
                
                     "dom":'<"row"<"col-xs-1 form-inline"><"col-md-4 form-inline"l><"col-md-5 form-inline"f><"col-md-3 form-inline"B>>rt<"row"<"col-md-8 form-inline"i> <"col-md-4 form-inline"p>>',
                
                     buttons: [
                                  {
                
                               extend:'copyHtml5',
                               titleAttr: 'Copiar Registros',
                               title:"Control de horas",
                               className: "btn  btn-outline-primary btn-sm"
                
                
                                  },
                                  {
                
                               extend:'excelHtml5',
                               titleAttr: 'Exportar Excel',
                               title:"Control de horas",
                               className: "btn  btn-outline-success btn-sm"
                
                
                                  },
                                   {
                
                               extend:'csvHtml5',
                               titleAttr: 'Exportar csv',
                               className: "btn  btn-outline-warning btn-sm"
                
                                  },
                                  {
                
                               extend:'pdfHtml5',
                               titleAttr: 'Exportar pdf',
                               className: "btn  btn-outline-secondary btn-sm"
                
                
                                  }
                               ]
                
                
                    });
                
                            },
            
    }
}();
