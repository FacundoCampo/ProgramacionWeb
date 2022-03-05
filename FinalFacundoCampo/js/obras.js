// PROCESO DE ALTA DE OBRA
let btnNuevaObra = document.querySelector('#btnNuevaObra');
let formObras = document.querySelector('#formObras');
let inputFormObras = formObras.querySelectorAll('input');
let descripcionFormObras = formObras.querySelector('textarea');


let notificacion = document.querySelector('#notificacion');
let notificacionContenedor = document.querySelector('#notificacionContenedor');

btnNuevaObra.addEventListener('click',function(e){
    e.preventDefault();
        formObras.style.display = "block";
     
})

/* ALTAS DE OBRAS */
formObras.addEventListener('submit', function (e){
    e.preventDefault();
    let nombre = inputFormObras[0].value;
    let precio = inputFormObras[1].value;
    let imagen = inputFormObras[2].value;
    let fecha = inputFormObras[3].value;
    console.log(fecha)
    let hora = inputFormObras[4].value;
    console.log(hora)
    let idCategoria = formObras.querySelector('select').value;
    let descripcion = descripcionFormObras.value;
    
    if(validarNumeroDecimal(precio) || validarNumeroEntero(precio)){
        if(validarSoloLetras(nombre)){
            // UNA VEZ VALIDADO LOS DATOS LOS ENVIO PARA QUE SE INSERTEN EN LA BASE DE DATOS
            var xhttp = new XMLHttpRequest();

           
    
            xhttp.open("POST", "procesos/alta-obras.php", true);
    
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
            xhttp.send("nombre="+nombre+"&precio="+precio+"&imagen="+imagen+"&fecha="+fecha+"&hora="+hora+"&idCategoria="+idCategoria+"&descripcion="+descripcion); 
                
            
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
                        formObras.style.display = 'none';
                        obtenerObras();
                    }
                      
    
                }
            };
        }else{
            notificacion.innerHTML = 'Error: el nombre solo puede contener letras.';
        }
    }else{
        notificacion.innerHTML = 'Error: el precio debe ser un valor numerico (entero o decimal).';
    } 

    notificacionContenedor.style.display = 'block';

});

formObras.addEventListener('reset', function (e){
    formObras.style.display = "none";
});


// LISTADO DE OBRAS

let listadoObras = document.querySelector('#listadoObras');
// OBTENGO LAS OBRAS DE MI BASE DE DATOS
function obtenerObras (){
    var xhttp = new XMLHttpRequest();

    /* POST */

    xhttp.open("GET", "procesos/listar-obras.php", true);

    xhttp.send(); 
        
    /* RESPUESTA RECIBIDA  */
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // OBTENGO EL RESULTADO 
            let respuesta = JSON.parse(this.responseText);
            
            
            let obras = respuesta.obras;
            // PINTO EL RESULTADO
            if(respuesta.error == false){
                listadoObras.innerHTML = obras;
            }
        }
    };
};

obtenerObras();

/* MODIFICAR OBRA */



function btnModificar (event){
    event.target.style.display='none';

    let inputsModificar = event.target.parentNode.querySelectorAll('.inputsModificar');
    let selectCategoria = event.target.parentNode.querySelector('#selectCategoria');
    selectCategoria.disabled = false;
    let selectEstado = event.target.parentNode.querySelector('#selectEstado');
    selectEstado.disabled = false;
    let modificarDescripcion = event.target.parentNode.querySelector('#modificarDescripcion');
    modificarDescripcion.disabled = false;

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
    let selectCategoria = event.target.parentNode.querySelector('#selectCategoria');
    selectCategoria.disabled = false;
    let selectEstado = event.target.parentNode.querySelector('#selectEstado');
    selectEstado.disabled = false;
    let modificarDescripcion = event.target.parentNode.querySelector('#modificarDescripcion');
    modificarDescripcion.disabled = false;

    console.log(inputsModificar)

    let nombreModificar = inputsModificar[0].value;
    let precioModificar = inputsModificar[1].value;
    let fechaModificar = inputsModificar[2].value;
    let horaModificar = inputsModificar[3].value;   
    let idObra = inputsModificar[4].value;
    let idCategoriaModif = selectCategoria.value;
    let descripcionModif = modificarDescripcion.value;
    let idEstado = selectEstado.value;
 
    if(nombreModificar != '' && precioModificar != '' && horaModificar != '' && fechaModificar != '' && idCategoriaModif != '' && descripcionModif != '' ){
        if(validarNumeroDecimal(precioModificar) || validarNumeroEntero(precioModificar)){
            if(validarSoloLetras(nombreModificar)){
                // UNA VEZ VALIDADO LOS DATOS LOS ENVIO PARA QUE SE INSERTEN EN LA BASE DE DATOS
            var xhttp = new XMLHttpRequest();

           
    
            xhttp.open("POST", "procesos/modificar-obras.php", true);
    
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
            xhttp.send("nombre="+nombreModificar+"&precio="+precioModificar+"&fecha="+fechaModificar+"&hora="+horaModificar+"&idCategoria="+idCategoriaModif+"&descripcion="+descripcionModif+"&estado="+idEstado+"&idObra="+idObra); 
                
            
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    let respuesta = JSON.parse(this.responseText);
                        notificacion.innerHTML = respuesta.notificacion;
                        // SI NO SE REPORTAN ERRORES EL LOGIN FUE EXITOSO Y REDIRECCIONO AL HOME
                    if(respuesta.error == false)
                    {
                        obtenerObras();
                    }
                      
    
                }
            };

            }else{
                notificacion.innerHTML = 'Error: el nombre solo puede contener letras.';
            }
        }else{
            notificacion.innerHTML = 'Error: el precio solo puede contener digitos.';
        }
    }else{
        notificacion.innerHTML = 'Error: No puede haber campos vacios.';
        
    }
    notificacionContenedor.style.display = 'block';
    
}
