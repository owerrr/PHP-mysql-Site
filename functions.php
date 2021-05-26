<?php

const server = "localhost";
const username = "root";
const password = null;
const database = "cw14";

function &getConnection():?mysqli {
    $conn = new mysqli(server, username, password, database);
    if($conn->connect_errno!=0){
        return null;
    }
    //$conn->query("SET NAMES utf8");
    $conn->set_charset("utf8");
    return $conn;
}
function getAllBooks():array {
    $conn = getConnection();
    if($conn === null) return [];
    $data = [];
    $sql = "SELECT books.id,books.title,books.author,books.price,category.label FROM books INNER JOIN category ON category.id = books.category_id;";
    $result = $conn->query($sql);
    if($result){
        while($row = $result->fetch_row()){
            $data[] = $row;
        }
    }
    $conn->close();
    return $data;
}
function booksToTable(array $books):string {

    if (count($books) <= 0 ) return "<h1 class='mb-3'>W tabeli obecnie nie ma rekordów.</h1><h3 class='mb-3'>Aby dodac jakiś rekord</h3><br/><a href='addNewBook.php'><input type='button' class='btn btn-success' value='KLIKNIJ TUTAJ'/></a>";

    $html = "<table class='table table-striped table-bordered'>";
    $html .= "<tr><th>Lp</th><th>Tytuł</th><th>Autor</th><th>Cena</th><th>Kategoria</th><th>Operacje</th></tr>";
    $lp = 0;
    $sum = 0;
    foreach($books as $b){
        $lp++;
        $sum += $b[3];

        $html .= "<tr><td class='text-end'>{$lp}</td><td>{$b[1]}</td><td>{$b[2]}</td><td class='text-end'>{$b[3]}</td><td>{$b[4]}</td><td><a href='confirmDelete.php?id={$b[0]}' class='btn btn-danger tblOperation'>Delete</a> <a href='editForm.php?id={$b[0]}' class='btn btn-primary tblOperation'>Edit</a></td></tr>";
    }
    $avg = round($lp>0 ? $sum/$lp : "Brak danych",2);

    $max = getMaxPrice();
    $min = getMinPrice();

    $html .="<tr class=''fw-bold><td class='text-end' colspan='3'>Max:</td><td class='text-end' colspan='3'>{$max}</td></tr>";
    $html .="<tr class=''fw-bold><td class='text-end' colspan='3'>Min:</td><td class='text-end' colspan='3'>{$min}</td></tr>";
    $html .="<tr class=''fw-bold><td class='text-end' colspan='3'>Średnia:</td><td class='text-end' colspan='3'>{$avg}</td></tr>";
    $html .="<tr class='fw-bold'><td class='text-end' colspan='3'>Suma:</td><td class='text-end' colspan='3'>{$sum}</td></tr></table>";
    return $html."<a href='addNewBook.php'><input type='button' class='btn btn-secondary' value='DODAJ KSIĄŻKĘ'/></a> <a href='addNewCategory.php'><input type='button' class='btn btn-secondary' value='DODAJ KATEGORIE'/></a> <a href='confirmDeleteCategory.php'><input type='button' class='btn btn-secondary' value='USUŃ KATEGORIE'/></a><br/><br/>";
}

function getMaxPrice():float{
    $conn = getConnection();
    if($conn == null) return 0;
    $sql = "SELECT MAX(books.price) FROM books";
    $res = $conn->query($sql);
    $max = $res ? $res->fetch_row()[0] : 0;
    $conn->close();
    return $max;
}

function getMinPrice():float{
    $conn = getConnection();
    if($conn == null) return 0;
    $sql = "SELECT MIN(books.price) FROM books";
    $res = $conn->query($sql);
    $min = $res ? $res->fetch_row()[0] : 0;
    $conn->close();
    return $min;
}

function deleteRecord(int $id):bool{
    $conn = getConnection();
    if($conn == null) return false;
    $sql = "DELETE FROM books WHERE ID = ".$id;
    $res = $conn->query($sql);
        if(!$res){
            $check = false;
        }else{
            $check = true;
        }
    $conn->close();
    return $check;
}

function deleteCategory(int $id):bool{
    $conn = getConnection();
    if($conn == null) return false;
    $sql = "DELETE FROM category WHERE ID = ".$id;
    $res = $conn->query($sql);
        if(!$res){
            $check = false;
        }else{
            $check = true;
        }
    $conn->close();
    return $check;
}

function getBooksById(int $id):array{
    $conn = getConnection();
    if($conn == null) return 0;
    $sql = "SELECT * FROM books WHERE ID = ".$id;
    $res = $conn->query($sql);
    $book = $res->fetch_array();
    if($book == null) return [];
    return $book;
}

function getCategoryById(int $id):array{
    $conn = getConnection();
    if($conn == null) return 0;
    $sql = "SELECT * FROM category WHERE ID = ".$id;
    $res = $conn->query($sql);
    $category = $res->fetch_array();
    return $category;
}

function newRow(string $title, string $author, float $price, int $category):void{
    $conn = getConnection();
    if($conn == null) return;

    // var_dump($title,$author,$price);

    $sql = "INSERT INTO books (title,author,price,category_id) VALUES
        ('".$title."','".$author."',".$price.",".$category.")";
    $res = $conn->query($sql);
    $conn->close();
}

function newCategory(string $label):void{
    $conn = getConnection();
    if($conn == null) return;
    $sql = "INSERT INTO category (label) VALUES
            ('".$label."')";
    $conn->query($sql);
    $conn->close();
}

function editRow(int $id, string $title, string $author, float $price, int $category):void{
    $conn = getConnection();
    if($conn == null) return;

    $sql = "UPDATE books SET    title = '".$title."'"
        .", author = '".$author."'"
        .", price = ".$price
        .", category_id = ".$category
        ." WHERE id = ".$id;
    $res = $conn->query($sql);
    $conn->close();
}






function createDatabase():void{
    $conn = new mysqli("localhost","root",null);
    $conn->query("CREATE DATABASE IF NOT EXISTS `cw14` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;");
    $conn->close();

    $conn = getConnection();

    $conn->query(
        "
        CREATE TABLE IF NOT EXISTS `category` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `label` varchar(50) COLLATE utf8_polish_ci NOT NULL,
            PRIMARY KEY (`Id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
        "
    );

    $conn->query(
        "
        CREATE TABLE IF NOT EXISTS `books` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `title` varchar(50) COLLATE utf8_polish_ci NOT NULL,
            `author` varchar(50) COLLATE utf8_polish_ci NOT NULL,
            `price` decimal(10,2) NOT NULL,
            `category_id` INT NOT NULL,
            CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES category(id),
            PRIMARY KEY (`Id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
        "  
    );

    $conn->close();
}

/*
INSERT INTO books (title,author,price,category_id) VALUES
    ("Jedrix. Umrę jutro","Robert Felix Crack",16.80,1),
    ("Dr. Stone tom 10","Boichi, Riichiro Inagaki",24.99,1),
    ("Niewidzialna Republika tom 3","Gabriel Hardman, Corinna Bechko",35.60,1),
    ("Sen w mroku","Szymon Hudon",34.99,2),
    ("Zmarli Pamiętają","Dominik Podworski",24.20,2),
    ("Dzień prawdy","Anna M. Brengos",23.00,3),
    ("Informacja zwrotna","Jakub Żulczyk",26.62,3),
    ("Dzień Armagedonu. Bitwa Jutlandzka","Wojciech Włódarczak",27.25,4),
    ("Sekrety Bieszczadów","Waldemar Bałda",27.93,4),
    ("Kruchy dom duszy","Jurgen Thorwald",31.00,4),
    ("Był sobie pies","W. Bruce Cameron",10.15,5),
    ("Niewolnica mafiosa","I.M. Darkss",27.99,6)
*/