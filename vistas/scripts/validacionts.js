function validacionts(){		
	var Soltd = document.getElementById('solicitud').selectedIndex;		
	var Descrip = document.getElementById('descripcion').value;
		
		if(Soltd == null || Soltd == 0){
			alert('ERROR: Debe seleccionar un tipo de Solicitud');
			return false;
		}
		
		if(Descrip == null || Descrip.length == 0 || /^\s+$/.test(Descrip)){
			alert('ERROR: El campo Descripcion NO debe ir vacío o lleno de espacios en blanco');
			return false;
		}
	}