<?php require $_SERVER['DOCUMENT_ROOT']."/web-app/vendor/autoload.php";?>
<?php
use App\Model\Sciday\Project;
$projectObj = new Project;   
$data=$projectObj->getAllProject();
echo json_encode($data);
?>