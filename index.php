<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type");

$obj = file_get_contents("php://input");
$json = json_decode($obj, true);
//test

$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $json['img']));

try {
  file_put_contents('tmp/'.$json['name'].'.png', $data);
} catch (\Exception $e) {
  header("Content-type: application/json; charset=utf-8");
  $response["status"] = 400;
  $response["msg"] = "Mem nie zostal zapisany.";
  echo json_encode($response);
} finally {
  header("Content-type: application/json; charset=utf-8");
  $response["status"] = 200;
  $response["msg"] = "Mem zapisany w galerii!";
  echo json_encode($response);
}

 ?>
