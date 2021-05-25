<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="cw14.css">
    <title>Dodaj nową ksiazke</title>
    <link rel="stylesheet" href="cw14.css">
</head>
<body>

    <?php
        require "functions.php";
        $html =<<<TEXT
        <div class='bookForm'>
            <form method="POST" action="newBook.php">
                <div class='line' style='text-align:center;'>
                    <h3 class='mb-3'>Dodaj nową ksiązkę</h3>
                </div>
                <div class="line">
                <label for="title" form-control>Tytuł</label>
                <input type="text" class="title form-control" name="title">
                </div>
                <div class="line">
                <label for="author">Autor</label>
                <input type="text" class="author form-control" name="author">
                </div>
                <div class="line">
                <label for="price">Cena</label>
                <input type="text" class="price form-control" name="price">
                </div>
                <div class="line">
                <label for="price">Kategoria</label>
                    <select class='category form-control' name='category'>
TEXT;
                        $conn = getConnection();
                        $categories = $conn->query("SELECT * FROM category");
                        if(count($categories->fetch_row()) <= 0) return $html.="<optgroup value='BRAK KATEGORII'>";
                        foreach($categories as $c){
                            $html .="<option value='{$c['id']}'>{$c['label']}</option>";
                        }
                        $conn->close();
              $html .='</select>
                        <a href="addNewCategory.php"><input type="button" class="addCategory btn btn-primary" value="+" /></a>
                </div>
                <div class="line">
                    <input type="submit" name="submit" value="Dodaj" class="formBtn btn btn-success">
                    <a href="cw14.php"><input type="button" name="back" value="Powrót" class="formBtn btn btn-danger"></a>
                </div>
            </form>
        </div>
        ';
        
        echo $html;


    ?>

</body>
</html>