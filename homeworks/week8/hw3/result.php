<?php
    header("refresh:2; url=./index.php");
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>TWGD week8 hw3</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
        <div class="card mx-auto mt-3" style="width: 500px;">
            <div class="card-body">
<?php
    if(isset($_GET["res"]) && $_GET["res"]==="success"){ ?>
                <div class="alert alert-success" role="alert">
                    購賣成功！
                </div>
<?php
    }
    if(isset($_GET["res"]) && $_GET["res"]==="error"){
?>
                <div class="alert alert-danger" role="alert">
                    交易失敗！
                </div>
<?php
    }
?>
            </div>
        </div>
    </body>
</html>