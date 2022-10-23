<?php
ini_set('display_errors', 0);

require_once $_SERVER['DOCUMENT_ROOT'].'/Classes/Response.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Config/db-config.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Controller/Users.cont.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Model/Users.model.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/Const/Api.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/helpers/FunctionSQL.php';

$Response = new Response();
$controller = new Users_Control($_REQUEST['method'], $_REQUEST['params']);

if(empty($controller->errors))
{
    $method = $controller->method;
    $msg = $controller->$method();//calling to method that selected from client side
    $state = true;
    if(!empty($controller->errors))
    {
        $msg = implode(",", $controller->errors);
        $state = false;
    }
}
else
{
    $msg = implode(",", $controller->errors);
    $state = false;
}

echo $Response->success()->setState($state)->setMsg($msg)->renderToEncode();//final response to client side(the $msg is the object)
?>