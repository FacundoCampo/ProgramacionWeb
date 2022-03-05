let formLogin = document.querySelector('#formLogin');
let notificacion = document.querySelector('#notificacion');
let notificacionContenedor = document.querySelector('#notificacionContenedor');


// CUANDO EL FORMULARIO ES ENVIADO O PROCESADO
formLogin.addEventListener('submit', function (e){
    e.preventDefault();
    // Valida que sea un mail y una contraseña
    let correo = document.querySelector('#inputCorreo').value;
    let password = document.querySelector('#inputPass').value;

    if(validateEmail(correo)){
        // Uso Ajax para que una vez que reciba la respuesta de login.php, 
        // me salte un apartado avisando si se logueo o hubo un error.
        var xhttp = new XMLHttpRequest();

        /* POST */

        xhttp.open("POST", "procesos/login.php", true); // Valido la informacion con la base de datos

        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhttp.send("correo="+correo+"&pass="+password); 
            
        /* RESPUESTA RECIBIDA  */
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // MUESTRO NOTIFICACION
                
                let respuesta = JSON.parse(this.responseText);
                    notificacion.innerHTML = respuesta.notificacion;
                    notificacionContenedor.style.display = 'block';
                    document.querySelector('.login').style.margin=0;
                    // SI NO SE REPORTAN ERRORES EL LOGIN FUE EXITOSO Y REDIRECCIONO AL HOME
                if(respuesta.error == false)
                {
                    location.href ="home.php"; // si se logueo correctamente me pasa a home.php
                }
                  

            }
        };
    }else{
        // SI EL MAIL NO ES VALIDO
        notificacion.innerHTML = 'Error: el mail ingresado no es un mail valido.';
        notificacionContenedor.style.display = 'block';
        document.querySelector('.login').style.margin=0;
    }

});