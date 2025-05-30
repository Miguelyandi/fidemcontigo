//función para traer el resumen de los widget del Detalle turnos
var Fidemcontigo = function(){
    return{
        fill_datatable1_resumen: function () {
                
                $("#detalle").empty();
                $("#detalle1").empty();
                $("#detalle2").empty();
                $("#detalle3").empty();
                $("#detalle4").empty();
                $("#detalle5").empty();
                $("#detalle6").empty();
                $("#detalle7").empty();
                

                $.ajax({
                    url: "informes-fidemcontigo",
                    dataType: "json",
                    success: function(data) {

            console.log(data);

                        // Widget trae el total de Pacientes


                         var item1 = data.detallesegui;
                        
                                $("#detalle").append(
                                    '<div class="small-box shadow-lg l-bg-blued-dark">' +
                                        '<div class="inner">' +
                                            '<ul style="list-style: none; padding-left: 0;">' +
                                                '<li><i class="fas fa-handshake"></i> <strong>Total Activos:</strong> ' + item1.total_activos + '</li>' +
                                                '<li><i class="fas fa-handshake"></i> <strong>Con Seguimiento:</strong> ' + item1.con_seguimiento + '</li>' +
                                                '<li><i class="fas fa-user-slash"></i> <strong>Sin Contacto:</strong> ' + item1.sin_contacto + '</li>' +
                                                '<li><i class="fas fa-question-circle"></i> <strong>Sin Seguimiento:</strong> ' + item1.sin_seguimiento + '</li>' +
                                            '</ul>' +
                                        '</div>' +
                                        '<div class="icon"><i class="fas fa-handshake"></i></div>' +
                                    '</div>'
                                );
                        
                        
                        
                       



                        $.each(data.totalEva, function(i, item1) {
                                $("#detalle1").append(
                                    '<div class="small-box shadow-lg l-bg-orange-dark">' +
                                        '<div class="inner">' +
                                            
                                            '<ul style="list-style: none; padding-left: 0; font-size: 15px;">' +
                                                '<li><i class="fas fa-thermometer-full"></i> EVA-9: <strong>' + item1.EVA9 + '</strong></li>' +
                                                '<li><i class="fas fa-thermometer-three-quarters"></i> EVA-8: <strong>' + item1.EVA8 + '</strong></li>' +
                                                '<li><i class="fas fa-thermometer-half"></i> EVA-7: <strong>' + item1.EVA7 + '</strong></li>' +
                                                '<li><i class="fas fa-thermometer-empty"></i> EVA-6: <strong>' + item1.EVA6 + '</strong></li>' +
                                            '</ul>' +
                                        '</div>' +
                                        '<div class="icon"><i class="fas fa-chart-line"></i></div>' +
                                    '</div>'
                                );
                            });

                        
                        
                        
                         let itemsHtml1 = '<div class="row">';

                        $.each(data.profesional, function(i, item1) {
                            itemsHtml1 +=
                                '<div class="col-md-6">' +
                                    '<li style="list-style: none; font-size: 15px;">' +
                                        '<i class="fas fa-user-check"></i> Dx: <strong>' +
                                        item1.codigo_profesional + ' : ' + item1.total +
                                        '</strong>' +
                                    '</li>' +
                                '</div>';
                        });
                        
                        itemsHtml1 += '</div>'; // cerrar la fila
                        
                        $("#detalle2").append(
                            '<div class="small-box shadow-lg l-bg-blue-dark">' +
                                '<div class="inner">' +
                                '<h6 class="mb-3"><strong>Profesionales Top 8</strong></h6>' +
                                    itemsHtml1 +
                                '</div>' +
                                '<div class="icon"><i class="fas fa-clinic-medical"></i></div>' +
                            '</div>'
                        );
                        
                        
                        //Widget PAcientes activos
    
                      
                        
                       let itemsHtml = '<div class="row">';

                        $.each(data.diagnostico, function(i, item1) {
                            itemsHtml +=
                                '<div class="col-md-6">' +
                                    '<li style="list-style: none; font-size: 15px;">' +
                                        '<i class="fas fa-user-check"></i> Dx: <strong>' +
                                        item1.dx_principal + ' : ' + item1.total +
                                        '</strong>' +
                                    '</li>' +
                                '</div>';
                        });
                        
                        itemsHtml += '</div>'; // cerrar la fila
                        
                        $("#detalle3").append(
                            '<div class="small-box shadow-lg l-bg-yellow-dark">' +
                                '<div class="inner">' +
                                '<h6 class="mb-3"><strong>Dx Top 6</strong></h6>' +
                                    itemsHtml +
                                '</div>' +
                                '<div class="icon"><i class="fas fa-clinic-medical"></i></div>' +
                            '</div>'
                        );
                          
                      
                      
                      

                        //Widget ambulatorios


                       /* $("#detalle4").append(

                            '<div class="small-box shadow-lg l-bg-cyan"><div class="inner">' +
                            '<h5><i class="fas fa-clinic-medical"></i> ' +
                            '</h5>' +
                            '<p><h6>PAC AMBULATORIOS<sup style="font-size: 15px"></sup></h6></p>' +
                            '</div><div class="icon"><i class="fas fa-clinic-medical"></i></div></div>'
                        );


                        //Widget Cantidad Hospitalizados


                        $("#detalle5").append(

                            '<div class="small-box shadow-lg l-bg-orange-dark"><div class="inner">' +
                            '<h5><i class="fas fa-ambulance"></i> ' + 
                            '</h5>' +
                            '<p><h6>TOTAL DOMICILIARIOS<sup style="font-size: 20px"></sup></h6></p>' +
                            '</div><div class="icon"><i class="fas fa-ambulance"></i></div></div>'
                        );



                        //Widget sin contacto y sin atención


                        $("#detalle6").append(

                            '<div class="small-box shadow-lg l-bg-red-dark"><div class="inner">' +
                            '<h5><i class="fas fa-phone-slash"></i> ' + data.sinc +" "+
                            '<i class="fas fa"></i><i class="fas fa-code"> </i> ' + data.noacepta +
                            '</h5>' +
                            '<p><h6 style="font-size: 10px">PACIENTES SIN CONTACTO Y NO QUIEREN ATENCIÓN<sup style="font-size: 10px"></sup></h6></p>' +
                            '</div><div class="icon"><i class="fas fa-phone-slash"></i></div></div>'
                        );



                        //Widget Egresados


                        $("#detalle7").append(

                            '<div class="small-box shadow-lg l-bg-yellow-dark"><div class="inner">' +
                            '<h5><i class="fas fa-door-open"></i> ' + data.egresados +
                            '</h5>' +
                            '<p><h6>PAC EGRESADOS<sup style="font-size: 20px"></sup></h6></p>' +
                            '</div><div class="icon"><i class="fas fa-door-open"></i></div></div>'
                        );*/
                        
                        

                    }
                })

            }
    }
}();
