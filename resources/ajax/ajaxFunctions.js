$(document).ready(function(){
    
    //var plazo = 0;
    var monto_capital = 0;
    var sueldo = 0;
    var tasa = 0;
    var plazo = 0;
    var seguro = 11875;
    var cuota = 0;
    var aporte = 0;
    /*Simulador de credito */
    $("#tasa").val(0);
        $("#monto_capital").val(0);
        $("#cuota").val(0);
    var plazo_personal = {"12":12,"18":14,"24":15,"36":16,"48":17,"60":18,"72":19,"84":20,"96":21};
    var plazo_promocion = {"12":9,"18":10,"24":11,"36":12,"48":13,"60":14,"96":18};
    var plazo_hipotecario = {"240":10,"120":13};
    var plazo_educa = {"12":8};
    $("input[name='tipo_prestamo']").click(function(){
        $("#cuota").val(0)
        $("#seguro").val(0)
        $("#total_cuota").val(0)
        
        var checado = $("input[name='tipo_prestamo']:checked").val();
        
        var html="<select name='select_plazo' id='id_plazo'> ";
        html += "<option name='personal' value='0'>Seleccione un Plazo</option>";
           
        //var checado = $("input[name='tipo_prestamo']:checked").val();

        if(checado == "personal"){
            $.each(plazo_personal,function(plazo,tasa) {  
                html += "<option name='personal' value='" + tasa + "'>"+ plazo+"</option>";
            });

        }else if(checado == "promocion"){
            $.each(plazo_promocion,function(plazo,tasa) {  
                html += "<option name='promocion' value='" + tasa + "'>"+ plazo+"</option>";
            });
        }else if(checado == "hipotecario"){
            $.each(plazo_hipotecario,function(plazo,tasa) {  
                html += "<option name='hipotecario' value='" + tasa + "'>"+ plazo+"</option>";
            });
        }else{
            $.each(plazo_educa,function(plazo,tasa) {  
                html += "<option name='educacion' value='" + tasa + "'>"+ plazo+"</option>";
            });
        }
       
        html+="</select>";
        
        $("#plazo").html(html)
        $("#id_plazo").change(function(){
            var $selected = $("#id_plazo").find('option:selected');
            plazo = $selected.text();
            tasa = $selected.val();
            if(tasa == 0){
                $("#tasa").val(0);
            }else{
                $("#tasa").val(tasa);
            }
        })
        
       
    });
    
    
				
    $("#btn_calcular_cuota").click(function(){
            var min = 500000;
            var max = 300000000;
            monto_capital = $("#monto_capital").val();
            if (isNaN($("#monto_capital").val())){
                $("#msg-status").css('display','block')
                $("#msg-status").html("Ingrese un capital valido Ej.: 500000.").delay(4000).hide("fade",1000)
                $("#monto_capital").val("");
            }else if(monto_capital < 500000 || monto_capital > 500000000){
                $("#msg-status").css('display','block')
                $("#msg-status").html("Monto minimo permitido: Gs. 500.000, maximo: Gs. 500.000.000.").delay(4000).hide("fade",1000)
                //$("#monto").val("");
                $("#cuota").val("")

            }else{

                //var tasa =  $("#tasa").val()

                //alert(parseFloat(tasa));
                var resultado = new Number(1 - (Math.pow((1 +  (tasa / (1200))),(-1 * plazo)))).toFixed(4);


                cuota = new Number((monto_capital * (tasa / (1200))) / resultado).toFixed(4);
                //$("#prestamo").val();
                $("#cuota").val(Math.round(cuota))
                $("#seguro").val(seguro);
                $("#total_cuota").val(seguro+Math.round(cuota));
            }
            
            
    })
     $("#sueldo").change(function(){
		 
		 aporte = $("#aporte").val(Math.round($("#sueldo").val()*0.11));
		 if (isNaN($("#sueldo").val())){
                    $("#msg-status").css('display','block')
                    $("#msg-status").html("Ingrese un sueldo valido Ej.: 500000.").delay(4000).hide("fade",1000)
                    $("#sueldo").val(0);
                    $("#aporte").val(0);
                                        
         }else if (isNaN($("#codeudor").val())){
                    $("#msg-status").css('display','block')
                    $("#msg-status").html("Ingrese un monto valido Ej.: 500000.").delay(4000).hide("fade",1000)
                    $("#codeudor").val(0);
                    
                                        
         }else if (isNaN($("#tarjeta_de_credito").val())){
                    $("#msg-status").css('display','block')
                    $("#msg-status").html("Ingrese un monto valido Ej.: 500000.").delay(4000).hide("fade",1000)
                    $("#tarjeta_de_credito").val(0);
                    
                                        
         }
			 
	 });
    
    
    $("#btn_calcular_disponibilidad").click(function(){
                
                var min = 500000;
                var max = 300000000;
                sueldo = $("#sueldo").val();
                
                var calc_aporte = Math.round(sueldo*0.11)
                
                
             
                var cuota_otros_prestamos =  $("#cuota_otros_prestamos").val();
                var tarjeta_de_credito = $("#tarjeta_de_credito").val();
                var codeudor = $("#codeudor").val();
                
                if(sueldo < 1605408 || sueldo > 300000000){
                    $("#msg-status").css('display','block')
                    $("#msg-status").html("Sueldo minimo permitido: Gs. 1.605.408, maximo: Gs. 500.000.000.").delay(4000).hide("fade",1000)
                    //$("#monto").val("");
                    $("#sueldo").val(0)
                    
                }else if(isNaN(tarjeta_de_credito)){
                    $("#msg-status").css('display','block')
                    $("#msg-status").html("Ingrese un monto valido Ej.: 1.297.000.").delay(4000).hide("fade",1000)
                    $("#tarjeta_de_credito").val(0);
                    
                }else if(isNaN(cuota_otros_prestamos)){
                    $("#msg-status").css('display','block')
                    $("#msg-status").html("Ingrese un monto valido Ej.: 1.297.000.").delay(4000).hide("fade",1000)
                    $("#cuota_otros_prestamos").val(0);
                    
                }else {
                    
                    var disponibilidad = sueldo-calc_aporte;
                   
                    
                    $("#disponibilidad").val(disponibilidad);
                    //alert("tarjeta: "+tarjeta_de_credito+" codeudor: "+codeudor)
                    var cuotas = Math.round(cuota)+Math.round(cuota_otros_prestamos)+Math.round(tarjeta_de_credito)+Math.round(codeudor);
                    
                    var porcentaje_endeudamiento = new Number(cuotas/disponibilidad*100).toFixed(2);
                    $("#endeudamiento").val(porcentaje_endeudamiento);
                    $("#max_cuota_permitida").val(Math.round(disponibilidad*70/100));
                    
                    
                    if(Math.round(porcentaje_endeudamiento) < 70){
                        $("#result").html("Reune los Requisitos");
                    }else{
                        $("#result").html("NO Reune los Requisitos");
                    }
                        
                }
            })
	
    
    
    
    
    
    
    set_interval();
    $(document).on('keypress',function(e){
        reset_interval();
        
    });
    /*
    $.mousemove(function(){
        reset_interval();
    });
    */
   $(document).on('mousemove',function(e){
	reset_interval();
        
    });
    $(document).on('contextmenu',function(e){
	reset_interval();
        
    });
    $(document).on('click',function(e){
	reset_interval();
        
    });
    $(document).on('scroll',function(e){
	reset_interval();
        
    });
    
       
    /* Mensajes */
    $("#idPopUpMensaje").click(function(){
        
        $.ajax({
           type: "POST",
           url: "./actions/update-sms-leidos.php"
           
        }).done(function() {
               
            $("#btn-modal-mensaje-close").click(function (){
                 window.location = "./index.php";
            });
        })     
               
    });
    /* Fin mensajes */
    
    
    /* PDDIRWEB DATA CHARGING */
    
    /* Pin changing proccess*/	
    $('#btn-save-new-pin').click(function(){
        
        var ci = $("#ci").val();
        var pin = $("#pin").val();
        var newPin = $("#newPin").val();             
        var confirmNewPin = $("#confirmNewPin").val();
        
        //Pin no puede ser vacio
        if(ci == "" || pin == "" || newPin == "" || confirmNewPin == "" || newPin != confirmNewPin){
            //Pin se debe confirmar
            if(newPin != confirmNewPin){
                alert("La confirmacion no coincide con su nuevo Pin");
            }else{
                alert("Todos los campos son requeridos");
            }
            
        }else if(newPin.length < 4 || confirmNewPin.length < 4){ //la longitud minima es de 4 numeros
                alert("Pin no es valido, ingrese un pin de 4 digitos")
        }else{
        
        $.ajax({
           type: "POST",
           url: "./actions/save-new-pin-process.php",
           data: {
               ci:ci,
               pin:pin,
               newPin:newPin
           }
           }).done(function(resp) {
               if(resp == 0){
                   alert("Su Pin actual es incorrecto");
               }else{
                    $("#modalChangePin").modal('hide');
                    window.location = "./index.php";
                    
               }
               
           });
        }
    })
    /* Fin gaurdar pin */


    /* Boton guardar info de banner */
    $('#btn-guardar-banner').click(function(){
       
        var titulo = $("#titulo-banner").val();
        var texto = $("#texto-banner").val();
        var nombre_imagen = $("#banner").val().split('\\').pop();
        var extension = nombre_imagen.split('.').pop();
        //validar que sean solo archivos imagen
        var validos = ["jpg", "png", "gif","jpeg"];
        if($.inArray(extension, validos) == -1){
            alert("Formato inválido de imagen, especifique otra imagen");
            return false;
        }else if(titulo.length == 0){
            alert("Especifique un titulo");
            return false;
        }else if(texto.length == 0){
            alert("Especifique un texto");
            return false;
        }
        /*Envio por ajax deshabilitado--
        else{
            //uploadFile('banner','archivo');        
            
            $.ajax({
               type: "POST",
               url: "./actions/save-banner-novedades.php",
               data: {
                   titulo:titulo,
                   texto:texto,
                   nombre_imagen:nombre_imagen

               }
            })
           
           
        }
        -- Fin de envio por ajax*/
        
       
    });
    
    
    /* Guardar novedades */
    $('#btn-guardar-novedades').click(function(){
       
        var titulo = $("#titulo-novedades").val();
        var texto = $("#texto-novedades").val();
        
        if(titulo.length == 0){
            alert("Especifique un titulo");
        }else if(texto.length == 0){
            alert("Especifique un texto");
        }else{
                
            $.ajax({
               type: "POST",
               url: "./actions/save-novedades.php",
               data: {
                   titulo:titulo,
                   texto:texto
                  
               }
               }).done(function() {
                   
                   alert("Guardado");
                   window.location = "./banner-admin.php";
               });
        }
    });
    /* Fin gaurdar novedades */
  
    
    /* Guardar pin */
    $('#btn-save-pin').click(function(){
        
        var ci = $("#ci").val();
        var pin = $("#show-pin").text();
        
        $.ajax({
           type: "POST",
           url: "./actions/save-pin-process.php",
           data: {
               ci:ci,
               pin:pin
           }
           }).done(function() {
               alert("Guardado")
               
           });
           
    })
    /* Fin gaurdar pin */
    
    
    
    
    
    /* Generacion de pin */
    $('#btn-generate-pin').click(function(){
       
        var $loading = $('#show-pin').html("<div class='progress progress-striped active'><div class='bar' style='width: 100%;'>Cargando.. </div></div>");
             var longitud = 4;
             $.ajax({
                type: "POST",
                url: "./actions/generate-pin-process.php",
                data: {longitud:longitud}
                }).done(function( data ) {
                    //alert("Pin generado");
                    $loading.html(data);
                });
             
    })
    /* Fin generacion de pin */
    
    /* Boton activa usuario */
    $("#activate-user-acount").click(function(){
        var ci = $("#ci-update").val();
        
        $.ajax({
                type: "POST",
                url: "./actions/activate-user.php",
                data: {ci:ci},
                success: function(data){
                    
                    window.location = "./users.php";
                    
              }
        });
    });
    
    
    /* Aplicar cambios user edit data */
    $("#btn-update-user-data").click(function(){

            var ci = $("#ci-update").val();
            var nombre = $("#nombre-update").val();
            var tipo_de_usuario = $("#tipo_de_usuario").val();
            var perfil = $("#perfil_de_usuario").val();

            //var password = $("#password-update").val();
            //var password2 = $("#password-update-re").val();
            
                    $.ajax({
                            type: "POST",
                            url: "./actions/update-user-data-action.php",
                            data: {ci:ci,nombre:nombre,tipo_de_usuario:tipo_de_usuario,perfil:perfil},
                            success: function(){
                                $("#modalUserData").modal("hide");
                                url = "./users.php";
                                $(location).attr('href',url);
                          }
                    });
               
            
        });  
    
    
    /* Administracion de Usuarios */
    $('#btn-user-update').click(function(){
        //alert("procesado...")
        //var rows = $("#tipoLocal").val();
        var ci = $("#input-ci").val()
        if(!ci){
            alert("Vacio");
        }else{
    
            var $loading = $('#visualizar-usuario').html("<div class='progress progress-striped active'><div class='bar' style='width: 100%;'>Cargando.. </div></div>");

             $.ajax({
                type: "POST",
                url: "./actions/user-update.php",
                data: {
                    ci:ci

                }
                }).done(function( data ) {
                    if(data == false){
                        data = "<div class='alert alert-warning'>No se encontro ningun registro..</div>";
                    }
                    $loading.html(data);

             });
        }
    })
    /* Fin administracion de usuarios */
    
    /* Mostrar datos de consulta */
    $('#btn-consultar').click(function(){
        consultar();
    })
    

    
    /* Listar Datos Reservacion */
    $('#btn-get-reservas').click(function(){
        //alert("procesado...")
	
		//INICIO
        var start = $("#startDateConsulta").val();        
        var aaaa_start = start.substring(6,10);
        var mm_start = start.substring(3,5);
        var dia_reserva_start = start.substring(0,2);
        
        hh_inicio = start.substring(11,13);
        mm_inicio = start.substring(14,16);
       
        //FIN
        var end = $("#endDateConsulta").val();
        var aaaa_end = end.substring(6,10);
        var mm_end = end.substring(3,5);
        var dia_reserva_end = end.substring(0,2);
        
        hh_final = end.substring(11,13);
        mm_final = end.substring(14,16);

        //alert(" De: "+aaaa_start+"-"+mm_start+"-"+dia_reserva_start+" "+hh_inicio+":"+mm_inicio+" A: "+aaaa_end+"-"+mm_end+"-"+dia_reserva_end+" "+hh_final+":"+mm_final);
        
        //Validaciones de rango de fecha
        if(aaaa_start > aaaa_end){
			alert("Error, el año inicial es mayor al año final");
			return 0;
		} else if(aaaa_start == aaaa_end){
			if(mm_start > mm_end){
				alert("Error, el mes inicial es mayor al mes final");
				return 0;
			} else if(mm_start == mm_end){
				if(dia_reserva_start > dia_reserva_end){
					alert("Error, el dia inicial es mayor al dia final");
					return 0;    
				}
			}
		}
		
        var tipo = $("#tipoLocal").val();
       
        var rows = $("#cantidadRegistros").val();

        var $loading = $('#lista-reservas').html("<div class='progress progress-striped active'><div class='bar' style='width: 100%;'>Ejecutandose </div></div>");
        
         $.ajax({
            type: "POST",
            //url: "/portal2/actions/listaReservas.php",
            url: "/portal2/actions/listaReservas2.php",
            data: {
                
                aaaa_start:aaaa_start,
                mm_start:mm_start,
                dia_reserva_start:dia_reserva_start,
                hh_inicio:hh_inicio,
                mm_inicio:mm_inicio,
                aaaa_end:aaaa_end,
                mm_end:mm_end,
                dia_reserva_end:dia_reserva_end,
                hh_final:hh_final,
                mm_final:mm_final,
                tipo:tipo,
                rows:rows
            }
            }).done(function( data ) {
                $loading.html(data);

         });
        
    })
    /* Fin datos reservacion */
    
    /* listar auditoria */
    $('#btn-get-auditoria').click(function(){
        //alert("procesado...")
        //var rows = $("#tipoLocal").val();
        var start = $("#startDateConsulta").val()
       
        var end = $("#endDateConsulta").val();
       
        var user_filter = $("#user_id_filter").val();
       
        var rows = $("#cantidadRegistros").val();

        var $loading = $('#lista-auditoria').html("<div class='progress progress-striped active'><div class='bar' style='width: 100%;'>Ejecutandose </div></div>");
        
         $.ajax({
            type: "POST",
            url: "/portal2/actions/auditoria-action.php",
            data: {
                start:start,
                end:end,
                user_filter:user_filter,
                rows:rows
            }
            }).done(function( data ) {
                $loading.html(data);

         });
        
    })
    /* Fin datos auditoria */
    
    
    
    
    $(".alert-msg-show").delay(4000).hide("fade",3000)
    $("#error-panel").delay(4000).hide("fade",3000)
    
    $("#btn-edit-user-data").click(function(){
            var ci = $("#ci-info").val();
            
            var numeroDeCasa = $("#numero-de-la-casa").val();
            //var barrio = $("#nombre-del-barrio").attr("name").val();
            var barrio = $('select[name=nombre-del-barrio] option:selected').attr('name') 
            
            var ciudad = $('select[name=nombre-de-la-ciudad] option:selected').attr('name') 
           
            var calle = $("#nombre-de-la-calle").val();
            var localidad = $('select[name=nombre-de-localidad] option:selected').attr('name') 
            var celular1 = $("#celular-1").val();
            var celular2 = $("#celular-2").val();
            var lineaBaja1 = $("#linea-baja-1").val();
            var lineaBaja2 = $("#linea-baja-2").val();
            var email = $("#e-mail").val();
            $.ajax({
                    type: "POST",
                    url: "./actions/edit-user-data-action.php",
                    data: {ci:ci,numeroDeCasa:numeroDeCasa,barrio:barrio,ciudad:ciudad,calle:calle,localidad:localidad,celular1:celular1,celular2:celular2,lineaBaja1:lineaBaja1,lineaBaja2:lineaBaja2,email:email},
                    success: function(){
                        $("#modalUserData").modal("hide");
                        url = "./index.php";
                        $(location).attr('href',url);
                  }
            });
            
            
        });  
        
        /* Funcion logout por inactividad */
        var timer = 0;
        function set_interval(){
            //the interval 'timer' is set as soon as the page loads
            timer = setInterval("auto_logout()",600000);
            // the figure '10000' above indicates how many milliseconds the timer be set to.
            //Eg: to set it to 5 mins, calculate 5min= 5x60=300 sec = 300,000 millisec. So set it to 300000
        }

        function reset_interval(){
            //resets the timer. The timer is reset on each of the below events:
            // 1. mousemove   2. mouseclick   3. key press 4. scroliing
            //first step: clear the existing timer
            
            if (timer != 0) {
                
                clearInterval(timer);
                timer = 0;
                //second step: implement the timer again
                timer = setInterval("auto_logout()",600000);
                // completed the reset of the timer
            }
        }

        
        /* fin de la funcion */
 
        $("#btn-accept-terms").click(function(){
            var ci = $("#id-accept-terms").val();
            update_accept_terms(ci);
        });
        
        
});
function auto_logout(){
            //this function will redirect the user to the logout script<br />
            window.location="./actions/login.exit.php";
        }
        
function btn_borrar_banner(id){
    alert("Borrar banner : "+id);
    $.ajax({
            type: "POST",
            url: "./actions/borrar-banner.php",
            data: {
                id:id
            },
            success: function(){
                alert("Borrado exitoso");
                $('#'+id).remove();
                url = "/portal2/banner-admin.php";
                window.location = url;
          }
    });
}


function consultar(){
		//alert("procesado...")
        //var rows = $("#tipoLocal").val();
        var ci = $("#input-ci").val()
        if( !(ci)){
            alert("Ingrese un numero de cedula valido")
            

        }else{
    
            var $loading = $('#visualizar-consulta').html("<div class='progress progress-striped active'><div class='bar' style='width: 100%;'>Cargando.. </div></div>");

             $.ajax({
                type: "POST",
                url: "/portal2/actions/listaConsulta.php",
                
                data: {
                    ci:ci

                }
                }).done(function( data ) {
                    if(data == false){
                        data = "<div class='alert alert-warning'>No se encontro ningun registro..</div>";
                    }
                    $loading.html(data);

             });
        }		

}

function verifyChangePin(){
        var ci = $("#ci").val();

	$.ajax({
           type: "POST",
           url: "./actions/verify-pin-change.php",
           data: {
               ci:ci,

           }
           }).done(function(resp) {
               if(resp == 1){
                   $("#modalChangePin").modal('show');
                   $('#ayudaCambioDePin').popover()
               }
               
           });
	
	
}

function update_accept_terms(ci){
        

	$.ajax({
           type: "POST",
           url: "./actions/update-accept-state.php",
           data: {
               ci:ci,

           }
           }).done(function(resp) {
                url = "./index.php";
                window.location = url;
               
           });
	
	
}
