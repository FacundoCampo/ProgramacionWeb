let listadoCategorias = document.querySelector('#listadoCategorias');
function obtenerCategorias (){
    var xhttp = new XMLHttpRequest();

    /* POST */

    xhttp.open("GET", "procesos/listar-categorias.php", true);

    xhttp.send(); 
        
    /* RESPUESTA RECIBIDA  */
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // OBTENGO EL RESULTADO 
            console.log(this.responseText)
            let respuesta = JSON.parse(this.responseText);
            
            
            let categorias = respuesta.categorias;
            // PINTO EL RESULTADO
            if(respuesta.error == false){
                listadoCategorias.innerHTML = categorias;
            }
        }
    };
};

obtenerCategorias();

let formCategorias =  document.querySelector('#formCategorias');
let btnNuevaCategoria = document.querySelector('#btnNuevaCategoria');
let inputFormCategorias = formCategorias.querySelectorAll('input');

btnNuevaCategoria.addEventListener('click',function(e){
    e.preventDefault();
    formCategorias.style.display = "block";
     
})

// ALTA CATEGORIA 

formCategorias.addEventListener('submit', function (e){
    e.preventDefault();
    let nombre = inputFormCategorias[0].value;
    console.log(nombre);
    if(validarSoloLetras(nombre)){
        // UNA VEZ VALIDADO LOS DATOS LOS ENVIO PARA QUE SE INSERTEN EN LA BASE DE DATOS
        var xhttp = new XMLHttpRequest();

        xhttp.open("POST", "procesos/alta-categorias.php", true);

        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhttp.send("nombre="+nombre); 
            
        
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // MUESTRO NOTIFICACION
                console.log(this.responseText);
                let respuesta = JSON.parse(this.responseText);
                    notificacion.innerHTML = respuesta.notificacion;
                    notificacionContenedor.style.display = 'block';
                    // SI NO SE REPORTAN ERRORES EL LOGIN FUE EXITOSO Y REDIRECCIONO AL HOME
                if(respuesta.error == false)
                {
                    formCategorias.style.display = 'none';
                    obtenerCategorias();
                }
                  

            }
        };
    }else{
        notificacion.innerHTML = 'Error: el nombre solo puede contener letras.';
    }
});

function btnModificar (event){
    event.target.style.display='none';

    let inputsModificar = event.target.parentNode.querySelectorAll('.inputsModificar');

    let btnGuardar = event.target.parentNode.querySelector('#btnGuardar');
    btnGuardar.style.display='inline';
    let btnCancelar =event.target.parentNode.querySelector('#btnCancelar');
    btnCancelar.style.display='inline';

    inputsModificar.forEach(input => {
        input.disabled = false;
        input.style.borderBottom ='1px solid';
    });
 
}

function btnGuardar (event){
    
    let inputsModificar = event.target.parentNode.querySelectorAll('.inputsModificar');
    let nombreModificar = inputsModificar[0].value;
    let idCategoria = inputsModificar[1].value;
    if(validarSoloLetras(nombreModificar)){
        // UNA VEZ VALIDADO LOS DATOS LOS ENVIO PARA QUE SE INSERTEN EN LA BASE DE DATOS
    var xhttp = new XMLHttpRequest();


    xhttp.open("POST", "procesos/modificar-categorias.php", true);

    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send("nombre="+nombreModificar+"&idCategoria="+idCategoria); 
        
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            let respuesta = JSON.parse(this.responseText);
                notificacion.innerHTML = respuesta.notificacion;
                // SI NO SE REPORTAN ERRORES EL LOGIN FUE EXITOSO Y REDIRECCIONO AL HOME
            if(respuesta.error == false)
            {
                obtenerCategorias();
            }
            
        }
    };

    }else{
        notificacion.innerHTML = 'Error: el nombre solo puede contener letras.';
    }
    notificacionContenedor.style.display = 'block';
}
