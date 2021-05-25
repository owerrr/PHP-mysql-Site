<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="cw14.css">
    <title>Dodaj nową kategorie</title>
    <link rel="stylesheet" href="cw14.css">
</head>
<body>

    <?php
        require "functions.php";
        $html = <<<TEXT
            <div class='bookForm'>
            <form method="POST" action="delete.php">
                <div class='line' style='text-align:center;'>
                    <h3 class='mb-3'>Czy chcesz usunąć kategorie</h3>
                </div>
                <div class='line'>
                <label for="price">Kategoria</label>
                <select class='category form-control' name='id' style='width:100%!important;'>
TEXT;
                    $conn = getConnection();
                    $categories = $conn->query("SELECT * FROM category");
                    if(count($categories->fetch_row()) <= 0) return $html.="<optgroup value='BRAK KATEGORII'>";

                    foreach($categories as $c){
                        $html .="<option value='{$c['id']}'>{$c['label']}</option>";
                    }
                    $conn->close();
          $html .='</select>
                </div>
                <div class="line">
                    <input type="text" style="display:none" name="type" value="category" />
                    <input type="submit" name="submit" value="TAK" class="formBtn btn btn-success">
                    <a href="cw14.php"><input type="button" name="back" value="NIE" class="formBtn btn btn-danger"></a>
                </div>                
            </form>
        </div>
        ';
        echo $html;
    ?>

</body>
</html>