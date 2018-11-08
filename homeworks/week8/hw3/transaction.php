<?php
    // create connection
    require("../connect.php");

    // 取得購買商品 id & 數量
    $arr_id = $_POST["product_id"];
    $arr_quantity = $_POST["quantity"];
    $arr_order = Array();
    for($i=0; $i<count($arr_id); $i++){
        $arr = Array(
            "product_id" => $arr_id[$i],
            "quantity" => $arr_quantity[$i]
         );
        array_push($arr_order, $arr);
    }
    // 去掉購買數量 0 的項目
    foreach($arr_order as $key => $value){
        if($value["quantity"]==="0"){
            unset($arr_order[$key]);
        }
    }


    // transaction
    try{
        $conn->autocommit(FALSE);
        $conn->begin_transaction();

        // prepare select & lock
        $sql_s = "SELECT quantity FROM products WHERE product_id= ? FOR UPDATE";
        $stmt_s = $conn->prepare($sql_s);
        $stmt_s->bind_param("i", $id);
        
        // prepare update
        $sql_u = "UPDATE products SET quantity = quantity - ? WHERE product_id = ?";
        $stmt_u = $conn->prepare($sql_u);
        $stmt_u->bind_param("ii", $quantity, $id);

        // prepare insert
        $sql_i = "INSERT INTO orders (product_id, quantity) VALUES (?, ?)";
        $stmt_i = $conn->prepare($sql_i);
        $stmt_i->bind_param("ii", $id, $quantity);
        

        foreach ($arr_order as $value){
            $id = (int)$value["product_id"];
            $quantity = (int)$value["quantity"];

            // select 庫存 & 檢查
            $stmt_s->execute();           
            $result = $stmt_s->get_result();
            $row = $result->fetch_assoc();
            if ($row["quantity"] - $quantity < 0){
                throw new Exception("商品庫存不足，交易失敗！");
            }          
            // update 庫存
            $stmt_u->execute();
            // insert 訂單記錄
            $stmt_i->execute();
        }

        $conn->commit();
        header("location:./result.php?res=success");
    }catch (Exception $e) {
        $conn->rollback();
        header("location:./result.php?res=error");
    }

    $stmt_s->close();
    $stmt_u->close();
    $stmt_i->close();
    $conn->close();
    
    
?>