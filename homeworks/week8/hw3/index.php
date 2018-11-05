<?php
    require("../connect.php");

    $sql = "SELECT product_id, product_name, quantity FROM products";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
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
                <h5 class="card-title">結帳頁面</h5>
                <p class="card-text">確認好商品數量後，請按結帳。</p>

                <form action="./transaction.php" method="POST">
<?php
    while($row = $result->fetch_assoc()){  ?>

                    <div class="form-group">
                        <input type="hidden" name="product_id[]" value="<?= $row['product_id'] ?>" />
                        <label for="<?= $row['product_id'] ?>"><?= $row["product_name"] ?>
                            <span class="badge badge-info">最後 <?= $row["quantity"]?> 個庫存</span>
                        </label>                        
                        <select name="quantity[]" class="form-control" id="<?= $row['product_id'] ?>">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
<?php
    }
?>
                    <button type="submit" class="btn btn-primary">結帳</button>
                </form>
            </div>
        </div>
        <div class="container mx-auto mt-3" style="width: 500px;">
            <a class="btn btn-primary" href="./reset.php" role="button">Reset DB</a>
            重設資料庫商品庫存數量 = 3
        </div>
        
            
        

        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>