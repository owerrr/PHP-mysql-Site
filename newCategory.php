<?php
require "functions.php";

if(isset($_POST['category'])){
    if(ctype_space($_POST['category']) || empty($_POST['category'])) return header("Location: errorPage.php?error=4");
    newCategory($_POST['category']);
}

header("Location: cw14.php");