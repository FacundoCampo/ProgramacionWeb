let formCompra = document.querySelector('#formCompra');
let subtotal = document.querySelector('#subtotal');
let inputCantidad = document.querySelector('#inputCantidad');
let precioObra = document.querySelector('#precioObra');

inputCantidad.addEventListener('input',function (){
    
   if(inputCantidad.value != ''){
    subtotal.innerHTML = parseFloat(precioObra.innerHTML) * parseInt(inputCantidad.value); 
    //Multiplico la entrada por la cantidad
   }else{
    subtotal.innerHTML = parseFloat(precioObra.innerHTML);
   }
    
})
formCompra.addEventListener('submit',function(e){ //Valido todos los datos 
    e.preventDefault();
    let tarjeta = document.querySelector('#inputTarjeta').value;
    let cantidad = inputCantidad.value;
    let idUser = document.querySelector('#idCliente').value;
    let idObra = document.querySelector('#idObra').value;
    let total = subtotal.innerHTML;
  
    if(validarNumTarjet(tarjeta)){
        if(cantidad != '' && total != '' && idUser != '' && idObra != ''){
            //Con un ajax le mando a alta-ventas.php para mandarlo a la base de datos
            var xhttp = new XMLHttpRequest();

            /* POST */

            xhttp.open("POST", "procesos/alta-ventas.php", true);

            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhttp.send("tarjeta="+tarjeta+"&cantidad="+cantidad+"&idUser="+idUser+"&idObra="+idObra+"&total="+total); 
                
            /* RESPUESTA RECIBIDA*/  
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    let respuesta = JSON.parse(this.responseText);
                    notificacion.innerHTML = respuesta.notificacion;
                    document.querySelector('#btnComprar').disabled = true;
                }
            };

        }else{
            notificacion.innerHTML = 'Error: se ha intentado insertados campos vacios, rellene todos los campos.';     
        }
    }else{
        notificacion.innerHTML = 'Error: el numero de tarjeta no es valido, deben ser 15 digitos.';
    }
    notificacionContenedor.style.display = 'block';
})