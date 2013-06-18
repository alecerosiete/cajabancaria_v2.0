$(document).ready(function(){
    /* PDDIRWEB DATA CHARGING */
    
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

        }else if(titulo.length == 0){
            alert("Especifique un titulo");
        }else if(texto.length == 0){
            alert("Especifique un texto");
        }else{
            uploadFile('banner','archivo');        
            $.ajax({
               type: "POST",
               url: "./actions/save-banner-novedades.php",
               data: {
                   titulo:titulo,
                   texto:texto,
                   nombre_imagen:nombre_imagen

               }
               }).done(function() {

                   alert("Guardado");
                   window.location = "./banner-admin.php";
               });
        }
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
       
        var ci = $("#ci-update").val();
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
        //alert("procesado...")
        //var rows = $("#tipoLocal").val();
        var ci = $("#input-ci").val()
        if( !(ci)){
            alert("Ingrese un numero de cedula valido")
            exit();

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
    })
    
    
    
    /* Listar Datos Reservacion */
    $('#btn-get-reservas').click(function(){
        //alert("procesado...")
        //var rows = $("#tipoLocal").val();
        var start = $("#startDateConsulta").val()
       
        var end = $("#endDateConsulta").val();
       
        var tipo = $("#tipoLocal").val();
       
        var rows = $("#cantidadRegistros").val();

        var $loading = $('#lista-reservas').html("<div class='progress progress-striped active'><div class='bar' style='width: 100%;'>Ejecutandose </div></div>");
        
         $.ajax({
            type: "POST",
            url: "/portal2/actions/listaReservas.php",
            data: {
                start:start,
                end:end,
                tipo:tipo,
                rows:rows
            }
            }).done(function( data ) {
                $loading.html(data);

         });
        
    })
    /* Fin datos reservacion */
    
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
        
});

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

