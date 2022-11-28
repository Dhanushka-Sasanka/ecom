<?php //require_once('header.php'); ?>
<?php
//require_once('header.php');
////if ($_POST['addToCart'] == "addToCart") {
////
////
////}
include("inc/config.php");

if (isset($_POST['p_id']) && $_POST['p_id']) {

    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
    $statement->execute(array($_POST['p_id']));
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

//    SELECT  `p_id`,  `p_name`,  `p_old_price`,  `p_current_price`,  `p_qty`,  `p_featured_photo`, LEFT(`p_description`, 256), LEFT(`p_short_description`, 256), LEFT(`p_feature`, 256), LEFT(`p_condition`, 256), LEFT(`p_return_policy`, 256),  `p_total_view`,  `p_is_featured`,  `p_is_active`,  `ecat_id` FROM `fashiony_ogs`.`tbl_product` LIMIT 1000;
//    $list =[];
    $list = array();
    foreach ($result as $row) {
        array_push($list, $row['p_id'], $row['p_name'], $row['p_current_price']);
    }
//    header('Content-Type: application/json');
    echo json_encode(array('success' => $list));

}


if (isset($_POST['selected_supplier']) && $_POST['selected_supplier'] && isset($_POST['orderItems']) && $_POST['orderItems'] && isset($_POST['amount']) && $_POST['amount']) {

    try {
        $pdo->beginTransaction();
        $statement = $pdo->prepare("INSERT INTO supplier_order(supplier_id, date, amount) VALUES (?,NOW(),?)");

        $statement->execute(array($_POST['selected_supplier'], $_POST['amount']));

        $insertProductsQuery = 'INSERT INTO sup_order_detail(pid, pname, qty,price,sup_order_id)VALUES';
        $orderItems = $_POST['orderItems'];
        $lastOrderId = $pdo->lastInsertId();

//    var_dump($orderItems);
        foreach ($orderItems as $key) {
            $insertProductsQuery .= '(' . $key['pid'] . ',"' . $key['productName'] . '",' . $key['qty'] . ',' . $key['price'] . ','.$lastOrderId.'),';
        }
        $insertProductsQuery = substr($insertProductsQuery, 0, -1);
//        var_dump($insertProductsQuery);
        $statement = $pdo->prepare($insertProductsQuery);

        $statement->execute();
        $result = $pdo->commit();
        if($result > 0){
            ;
            echo json_encode(array('success' => "1"));
        }else{
            echo json_encode(array('success' => "0"));
        }

    } catch
    (PDOException $e) {
        // Failed to insert the order into the database so we rollback any changes
        $pdo->rollback();
        throw $e;
    }
}
