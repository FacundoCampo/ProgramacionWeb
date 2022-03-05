<?php 

include_once('../includes/conexion.php');


// crear una sentencia preparada 
$consulta = $conexion->prepare("SELECT * FROM categoria");
// ejecutar la consulta 
$consulta->execute();

// OBTENER RESULTADOS
$resultado = $consulta->get_result();

$listado = '';
if($resultado->num_rows > 0){
    while ($fila = $resultado->fetch_assoc()) {
    $listado .= '<div class="obra" >
        <form>
            <p><b>Nombre:</b> <input type="text" id="modificarCategoria" class="inputsModificar" value="'.$fila['nombre'].'" disabled></p>
            <input type="hidden" id="idCategoria" class="inputsModificar" value="'.$fila['idCategoria'].'" disabled>
            <a class="btn-modificar btnModificar" onclick="btnModificar(event)">Modificar</a>
            <a id="btnGuardar" class="btn-modificar d-none" onclick="btnGuardar(event)">Guardar</a>
            <a id="btnCancelar" class="btn-cancelar d-none">Cancelar</a>
        </form>
    </div>
    ';
}
$error = false;
}else{
    $error = true;
}

$arrayRespuesta = ['categorias' => $listado,'error'=>$error];
echo json_encode($arrayRespuesta);
?>