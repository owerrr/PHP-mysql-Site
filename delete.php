<?php
require "functions.php";

if(!isset($_POST['type'])) return header("Location: errorPage.php");
var_dump($_POST['id']);
$id = $_POST['id'];
if($_POST['type'] == 'category'){
    $check = deleteCategory($id);
}
else if($_POST['type'] == 'book'){
    $check = deleteRecord($id);
}

if(!$check){
    header("Location: errorPage.php?error=5");   
}else{
    header("Location: cw14.php");
}


