<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-headers: Content-Type, Authorization, X-Requested-Whith");
header('Content-Type: application/json; charset=UTF-8');

include "config/database.php";

$mysqli = new database();

$conect = $mysqli->conectar('slothsof_repertorio');

$postjson = json_decode(file_get_contents('php://input'), true);

$conect->set_charset("utf8");


if($postjson['tipoMov'] == "getData")
{
    $query = mysqli_query($conect, "SELECT * FROM prueba");

    $check = mysqli_num_rows($query);

    if($check>0)
    {
        $data = mysqli_fetch_array($query);
        $data = array
        (
            'titulo' => $data ['titulo'],
            'contenido' => $data ['contenido']
        );
        $result = json_encode(array('success' => true, 'result' =>$data));
    }
    else
    {
        $result = json_encode(array('success' => false, 'msg' =>'no hay datos'));
    }
    echo $result;
}
$mysqli->desconectar();
?>