<?php
require "functions.php";
if(filter_has_var(INPUT_GET,'id') && filter_has_var(INPUT_POST,'title') && filter_has_var(INPUT_POST,'author') && filter_has_var(INPUT_POST,'price') && filter_has_var(INPUT_POST,'category')){
    if(ctype_space($_POST['title']) || empty($_POST['title'])) return header("Location: errorPage.php?error=1");
    else if(ctype_space($_POST['author']) || empty($_POST['author'])) return header("Location: errorPage.php?error=2");
    else if(ctype_space($_POST['price']) || empty($_POST['price'])) return header("Location: errorPage.php?error=3");
    if(!is_numeric(str_replace(",",".",$_POST['price']))) return header("Location: errorPage.php?error=3");
    $price = str_replace(",",".",$_POST['price']);
    if($price < 0) return header("Location: errorPage.php?error=3");
    editRow($_GET['id'], $_POST['title'], $_POST['author'], $price, $_POST['category']);
}
header("Location: cw14.php");