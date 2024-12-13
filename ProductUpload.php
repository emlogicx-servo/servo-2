<?php
$servername = 'localhost';
$username = 'root';
$password = 'root';
if(isset($_POST["submit"])) {
    $products = array_map('str_getcsv', file($_FILES['fileToUpload']['tmp_name']));
    print_r($product);
    // try {
    //     $conn = new PDO("mysql:host=$servername;dbname=servodb", $username, $password);
    //     // set the PDO error mode to exception
    //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //     $file = fopen('prod_templage_csv.csv', 'r');
    //     $products = [];
    //     $products = array_map('str_getcsv', file('prod_templage_csv.csv'));
    //     foreach ($products as $product => $value) {
    //         $stmt = $conn->prepare(
    //                 "INSERT INTO servo_products (product_name,product_picture,product_description,product_type,servo_product_category_product_category_id) VALUES (:product_name,:product_picture,:product_description,:product_type,:servo_product_category_product_category_id)");
    //         $stmt->bindParam(':product_name', $product_name);
    //         $stmt->bindParam(':product_picture', $product_picture);
    //         $stmt->bindParam(':product_description', $product_description);
    //         $stmt->bindParam(':product_type', $product_type);
    //         $stmt->bindParam(':servo_product_category_product_category_id', $servo_product_category_product_category_id);
    
    //         $product_name = $value[1];
    //         $product_picture = $value[2];
    //         $product_description = $value[3];
    //         $product_type = $value[4];
    //         $servo_product_category_product_category_id = $value[5];
    //         $stmt->execute();
    //         $servicePrice = explode(',', $value[6]);
    //         $lastId = $conn->lastInsertId();
    //         // print_r($last_id);
    //         foreach ($servicePrice as $key => $value) {
    //             $price = explode(':', $value);
    //             $stmt = $conn->prepare('INSERT INTO servo_product_price (product_price,product_price_product_id,servo_service_service_id,product_price_code) VALUES (:product_price,:product_price_product_id,:servo_service_service_id,:product_price_code)');
    //             $stmt->bindParam(':product_price', $product_price);
    //             $stmt->bindParam(':product_price_product_id', $product_price_product_id);
    //             $stmt->bindParam(':servo_service_service_id', $servo_service_service_id);
    //             $stmt->bindParam(':product_price_code', $product_price_code);
    
    //             $product_price = $value[1];
    //             $product_price_product_id = $lastId;
    //             $servo_service_service_id = $value[0];
    //             $product_price_code = $product_price_product_id.'@'.$servo_service_service_id.'@';
    
    //             $stmt->execute();
    //         }
    //     }
    //     echo 'Connected successfully';
    // } catch (PDOException $e) {
    //     echo 'Connection failed: ' . $e->getMessage();
    // }
  } else{
    echo "sssssssssssssssssssssssss";
  }


