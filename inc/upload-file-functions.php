<script type="text/javascript">		
//    var typeAudio;
    //progreso actual
    //var currProgress = 0;
    //esta la tarea completa
    //var done = false;
    //cantidad total de progreso
    //var total = 100; 
    
    function uploadFile(type,formFileName){
                    //var url = "http://localhost/ReadMoveWebServices/WSUploadFile.asmx?op=UploadFile";	
            if(formFileName == "archivo"){
                var url = "./actions/save-banner-action.php";
            }
            
             
        
            var archivoSeleccionado = document.getElementById(type);
            var file = archivoSeleccionado.files[0];
            var fd = new FormData();
            fd.append(formFileName, file);
            var xmlHTTP= new XMLHttpRequest();		
            
            //xmlHTTP.upload.addEventListener("loadstart", loadStartFunction, false);
            
            xmlHTTP.upload.addEventListener("progress", progressFunction, false);
            xmlHTTP.addEventListener("load", transferCompleteFunction, false);
            xmlHTTP.addEventListener("error", uploadFailed, false);
            xmlHTTP.addEventListener("abort", uploadCanceled, false);	
            
            xmlHTTP.open("POST", url, true);                  
            xmlHTTP.send(fd);
            
            
    }		

   
    
    function progressFunction(evt){

        //startProgress(evt);
            //$("#form-labels").css('display', 'inline');
            // modal
            //$('#myModal').modal('show');
        
           
            var progressBar = document.getElementById("progressBar");
            var percentageDiv = document.getElementById("percentageCalc");
            if (evt.lengthComputable) {
                 
                    progressBar.max = evt.total;
                    progressBar.value = evt.loaded;
                    percentageDiv.innerHTML = Math.round(evt.loaded / evt.total * 100) + "%";
            }
            
            
    }

    function loadStartFunction(evt){
            alert('Comenzando a subir el archivo');
    }
    function transferCompleteFunction(evt){
            var progressBar = document.getElementById("progressBar");
            var percentageDiv = document.getElementById("percentageCalc");
            progressBar.value = 100;
            percentageDiv.innerHTML = "100%";
            //$('#barProgreso').css('width','0');
            //$('#myModal').modal('hide');
            //$('#btn-campaign-test-start').attr('disable',true);
    }	

    function uploadFailed(evt) {
            alert("Hubo un error al subir el archivo.");
    }

    function uploadCanceled(evt) {
            alert("La operación se canceló o la conexión fue interrunpida.");
    }
    

    
   //funcion para actualizar el progreso
   function startProgress(evt) {
        //recuperamos el elemento de progreso
        var prBar = document.getElementById("prog");
        //get the start button
        //var startButt = document.getElementById("startBtn");
        //recuperamos el valor del texto
        var val = document.getElementById("numValue");
        //deshabilitamos el botón
        //startButt.disabled=true;
        //actualiza la barra de progreso
        //progressBar.max = evt.total;
        //progressBar.value = evt.loaded;
        prBar.value = currProgress;
        $('#barProgreso').css('width',currProgress+'%');
        //actualizamos el indicador visual con el texto
        val.innerHTML = Math.round((currProgress/total)*100)+"%";
        //incrementamos el valor del progreso cada vez que la función se ejecuta
        currProgress++;
        //comprobamos si hemos terminado
        if(currProgress>100) done=true;
        // sino hemos terminado, volvemos a llamar a la función después de un tiempo
        if(!done)
          setTimeout("startProgress()", 100);
        //tarea terminada, habilitar el botón y resetear variables
        else   
        {
          //document.getElementById("startBtn").disabled = false;
          done = false;
          currProgress = 0;
    }

}


 /* Validar formato de imagen */
function validar_formato_imagen(){
    //alert("Entro!");
        var nombre_imagen = $("#banner").val().split('\\').pop();
            var extension = nombre_imagen.split('.').pop();
            //validar que sean solo archivos imagen
            var validos = ["jpg", "png", "gif","jpeg"];
            //alert($.inArray(extension, validos));
            
            if(jQuery.inArray(extension, validos) === -1){
                
                alert("Formato inválido de imagen");
                $("#banner").replaceWith($("#banner").clone());

            }
}

</script>


