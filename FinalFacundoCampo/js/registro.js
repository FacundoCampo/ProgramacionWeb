let formRegistro = document.querySelector('#formRegistro');
let notificacion = document.querySelector('#notificacion');
let notificacionContenedor = document.querySelector('#notificacionContenedor');

formRegistro.addEventListener('submit', function (e){
    e.preventDefault();
    //Tomo los datos del input
    let nombre = document.querySelector('#inputNombre').value;
    let correo = document.querySelector('#inputCorreo').value;
    let password = document.querySelector('#inputPass').value;
    let passwordConfirm = document.querySelector('#inputPassConfirm').value;

    if(!validateEmail(correo)){
         // SI EL MAIL NO ES VALIDO
         notificacion.innerHTML = 'Error: el mail ingresado no es un mail valido.';
    }else if(!validarSoloLetras(nombre)){
        notificacion.innerHTML = 'Error: el nombre ingresado debe contener solo letras.';
    }else{
        // PETICION AJAX
        var xhttp = new XMLHttpRequest();

        /* POST */

        //Le paso los datos a registro.php para que me valide con la base de datos los datos obtenidos
        xhttp.open("POST", "procesos/registro.php", true); 
 
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //Con este le paso los datos
        xhttp.send("correo="+correo+"&pass="+password+"&nombre="+nombre+"&passConfirm="+passwordConfirm); 
            
        /* PROCESAR RESPUESTA RECIBIDA*/  
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                let respuesta = JSON.parse(this.responseText);
                
                notificacion.innerHTML = respuesta.notificacion;
                if(respuesta.error == false){ //Si esta todo bien me pone con ajax un boton para el login
                    notificacion.innerHTML +='<a href="index.php" class="btn-login mt-4">Ingresar</a>';
                }
            }
        };

    }

    notificacionContenedor.style.display = 'block';
    document.querySelector('.login').style.margin=0;

    
    

});