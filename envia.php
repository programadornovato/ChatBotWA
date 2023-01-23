<?php
//enviar.php
/*
 * RECIBIMOS LA RESPUESTA
*/
function enviar($recibido, $enviado, $idWA,$timestamp,$telefonoCliente) {
    require_once './conexion.php';

    //INSERTAMOS LOS REGISTROS DEL ENVIO DEL WHATSAPP
    $sql = "INSERT INTO registro "
           . "(mensaje_recibido    ,mensaje_enviado   ,id_wa        ,timestamp_wa        ,     telefono_wa) VALUES "
           . "('" . $recibido . "' ,'" . $enviado . "','" . $idWA . "','" . $timestamp . "','" . $telefonoCliente . "');";
    $conn->query($sql);
    $conn->close();
}
