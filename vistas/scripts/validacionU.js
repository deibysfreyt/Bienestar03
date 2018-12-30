function validacionU(){
	var CedulaU = document.getElementById('cedula').value;
	var NombreU = document.getElementById('nombre_apellido').value;
	var Telef = document.getElementById('telefono').value;
	var CorreoU = document.getElementById('email').value;
	var CargoU = document.getElementById('cargo').value;
	var LoginU = document.getElementById('login').value;
	var ClaveU = document.getElementById('clave').value;
 
		//Test campo obligatorio del Solicitante
		if(CedulaU == null || CedulaU.length == 0 || isNaN(CedulaU)){
			alert('ERROR: El campo Cedula debe ingresar solo numeros');
			return false;
		}
		if(NombreU == null || NombreU.length == 0 || /^\s+$/.test(NombreU)){
			alert('ERROR: El campo Nombre NO debe ir vacío o lleno de solamente espacios en blanco');
			return false;
		}
		if(Telef == null || Telef.length == 0 || !(/^[0]\d{3}\-\d{7}$/.test(Telef)) || /^\s+$/.test(Telef) ){
			alert('ERROR: El campo Telefono debe ingresar un formato 0416-1237788');
			return false;
		}
		if(!(/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$/.test(CorreoU)) && CorreoU != null && CorreoU.length != 0){
			alert('ERROR: Debe escribir un correo válido: ejemplo@example.com');
			return false;
		}
		if(CargoU == null || CargoU.length == 0 || /^\s+$/.test(CargoU)){
			alert('ERROR: El campo Cargo NO debe ir vacío o lleno de solamente espacios en blanco');
			return false;
		}
		if(LoginU == null || LoginU.length == 0 || /^\s+$/.test(LoginU)){
			alert('ERROR: El campo Login del Usuario NO debe ir vacío');
			return false;
		}
		if(ClaveU == null || ClaveU.length == 0 || /^\s+$/.test(ClaveU)){
			alert('ERROR: El campo Clave NO debe ir vacío o lleno de solamente espacios en blanco');
			return false;
		}

	}