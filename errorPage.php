<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="cw14.css">
    <title>ERROR</title>
</head>
<body>
    
    <div class='bookForm' style='text-align:center;'>
        <h1 class='mb-2' style='color:red;'>ERROR</h1>
        <?php

            require "errors.php";

            if(isset($_GET['error'])){
                switch($_GET['error']){
                    case 1:
                        $reason = error1;
                    break;
                    case 2:
                        $reason = error2;
                    break;
                    case 3:
                        $reason = error3;
                    break;
                    case 4:
                        $reason = error4;
                    break;
                    case 5:
                        $reason = error5;
                    break;
                    default:
                        $reason = unexpectedError;
                    break;
                }
            }else{
                $reason = unexpectedError;
            }
            echo "<h5 class='mb-3'>{$reason}</h4>"
        ?>
        Aby powrócić do strony głównej<br/>
        <a href='cw14.php'><input type='button' class='btn btn-success' value='KLIKNIJ TUTAJ' /></a>
    </div>

</body>
</html>