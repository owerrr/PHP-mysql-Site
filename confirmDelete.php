<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="cw14.css">
    <title>Edytuj ksiązke</title>
    <link rel="stylesheet" href="cw14.css">
</head>
<body>

    <?php
        require "functions.php";
        if(!getBooksById($_GET['id'])) return header("Location: errorPage.php?error=6");
        $b = getBooksById($_GET['id']);
        

        echo <<<TEXT
            <div class='bookForm'>
            <form method="POST" action="delete.php">
                <div class='line' style='text-align:center;'>
                    <h3 class='mb-3'>Czy na pewno chcesz usunąc tę ksiązkę?</h3>
                </div>
                <div class="line">
                    <label for="id">Id</label>
                    <input type="text" class="id form-control" disabled value="{$b[0]}">
                </div>
                <div class="line">
                    <label for="title" form-control>Tytuł</label>
                    <input type="text" class="title form-control" name="title" disabled value="{$b[1]}">
                </div>
                <div class="line">
                    <label for="author">Autor</label>
                    <input type="text" class="author form-control" name="author" disabled value="{$b[2]}">
                </div>
                <div class="line">
                    <label for="price">Cena</label>
                    <input type="text" class="price form-control" name="price" disabled value="{$b[3]}">
                </div>
                <div class="line">
                    <input type="text" style="display:none" name="type" value="book" />
                    <input type="text" style="display:none" name="id" value="{$b[0]}">
                    <input type="submit" name="submit" value="TAK" class="formBtn btn btn-success">
                    <a href="cw14.php"><input type="button" name="back" value="NIE" class="formBtn btn btn-danger"></a>
                </div>
            </form>
        </div>
TEXT;

    ?>

</body>
</html>