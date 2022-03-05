<?php 

include_once('../includes/conexion.php');


// crear una sentencia preparada 
$consulta = $conexion->prepare("SELECT * FROM obras ORDER BY fecha");
// ejecutar la consulta 
$consulta->execute();




// OBTENER RESULTADOS
$resultado = $consulta->get_result();

$listado = '';

if($resultado->num_rows > 0){
    while($fila = $resultado->fetch_assoc())
    {
       // SELECCIONAR CATEGORIAS PARA RELLENAR EL SELECT
    // OBTENER CATEGORIAS PARA RELLENAR EL SELECT
    $consulta = $conexion->prepare("SELECT * FROM categoria ORDER BY nombre");
    $consulta->execute();
    $categorias = $consulta->get_result();

        $listado .= '
        <div class="obra">
            <form>
                <img class="img-width" src="img/'.$fila['img'].'" alt="">
                <p><b>Nombre:</b> <input type="text" id="modificarTitulo" class="inputsModificar" value="'.$fila['nombre'].'" disabled></p>
                <p><b>Precio:</b> $<input type="text" id="modificarPrecio" class="inputsModificar" value="'.$fila['precio'].'" disabled></p>
                <p><b>Fecha:</b> <input type="text" id="modificarFecha" class="inputsModificar" value="'.$fila['fecha'].'" disabled></p>
                <p><b>Hora:</b> <input type="time" id="modificarHora" class="inputsModificar" value="'.$fila['hora'].'" disabled></p>
                <input type="text" id="modificarIdObra" class="inputsModificar d-none" value="'.$fila['idObra'].'" disabled>
                <p><b>Descripcion:</b> <textarea id="modificarDescripcion" class="d-block" style="width:100%" rows="5" disabled required>'.$fila['descripcion'].'</textarea> </p>';

        
        /* ARMADO SELECT CATEGORIAS */
            $select = '<p><b>Categoría:</b> <select id="selectCategoria" disabled>';

            while($categoria = $categorias->fetch_assoc()){
                if($fila['idCategoria'] == $categoria['idCategoria']){
                    $select .= '
                <option value="'.$categoria['idCategoria'].'" selected>'.$categoria['nombre'].'</option>
                ';
                }else{
                    $select .= '
                <option value="'.$categoria['idCategoria'].'">'.$categoria['nombre'].'</option>
                ';
                }
                

            }

            $select .= '</select></p>';
            $listado.=$select;

        if($fila['activa']){
            $listado.='
                <p style="margin-bottom:2rem;"><b>Estado:</b> 
                <select id="selectEstado" disabled>
                    <option value="0">Inactiva</option>
                    <option value="1" selected>Activa</option>
                </select>
                </p>';
        }else{
            $listado.='
                <p style="margin-bottom:2rem;"><b>Estado:</b> 
                <select id="selectEstado" disabled>
                <option value="0" selected>Inactiva</option>
                <option value="1">Activa</option>
                </select>
            </p>';
        }
        
        $listado.=    
                '
                <a class="btn-modificar btnModificar" onclick="btnModificar(event)">Modificar</a>
                <a id="btnGuardar" class="btn-modificar d-none" onclick="btnGuardar(event)">Guardar</a>
                <a id="btnCancelar" class="btn-cancelar d-none">Cancelar</a>
            </form>
        </div>';
    }
    $error = false;
}else{
    $error = true;
    $filas = 0;
}
$arrayRespuesta = ['obras' => $listado,'error'=>$error];

echo json_encode($arrayRespuesta);

?>