<?php
header('Content-Type: application/json');
require_once "dataAccess.php";

$action="";

if(isset($_GET["action"])){
    $action=$_GET["action"];
}

$dataAccess = new DataAccess;
$return="";
switch ($action) {
    case 'create':
        $person = json_decode(file_get_contents('php://input'), false);
        $return=$dataAccess->createPerson($person);
        break;
    case 'update':
        $person = json_decode(file_get_contents('php://input'), false);
        $return=$dataAccess->updatePerson($person);
        break;
    case 'delete':
        $person = json_decode(file_get_contents('php://input'), false);
        $return=$dataAccess->deletePerson($person->person_id);
        break;
    case 'pages':
        $return=$dataAccess->getPeoplePagesCount();
        break;
     default:
        $page=0;
        if(isset($_GET["page"])){
            $page=$_GET["page"];
        }
        $return=$dataAccess->getAllPeopleByPage($page);
}
echo '{"result":'.json_encode($return).'}';

?>