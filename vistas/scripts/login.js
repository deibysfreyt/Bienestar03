$("#frmAcceso").on('submit',function(e){ 
	e.preventDefault(); // Nose activara la acción predeterminada del evento del formulario sutmit
    logina=$("#logina").val(); // Guarda el login en la variable
    clavea=$("#clavea").val(); // Guarda la contraseña en la variable
        //Mediante AJAX envia las dos variable como objeto
    $.post("../ajax/usuario.php?op=verificar",
        {"logina":logina,"clavea":clavea},
        function(data){
                //Al evaluar "data"
            if (data != 'false'){ // Si el data es distinto de false es que hubo coincidencia da datos
                    //lo direcciona al informa social
                $(location).attr("href","informe_social.php");                  
            }else{ // Al no tener coincidencia con la base de datos el data es false
                bootbox.alert("Usuario y/o Password incorrectos"); // Emite un mansaje
        }
    });
})