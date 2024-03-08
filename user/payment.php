<?php
    include('../dbconn.php');
    session_start();

    $uid = $_SESSION['user_id'];

    if($uid != null){
        $stmt = $pdo->prepare('SELECT * FROM cart WHERE user_id = :user_id');
        $stmt->bindParam(':user_id', $uid);
        $stmt->execute();
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    $total_amount = 0;

    foreach($cartItems as $item){
        $total_amount += $item['price'] * $item['quantity']; 
    }
    

    $paisa = 100 * $total_amount;

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{
     "return_url": "http://localhost/Bloom/user/success.php",
     "website_url": "https://127.0.0.1/",
     "amount": "' . $paisa . '",

    "purchase_order_id": "Order01",
        "purchase_order_name": "test",

    "customer_info": {
        "name": "Test Bahadur",
        "email": "test@khalti.com",
        "phone": "9800000001"
    }
    }

    ',
    CURLOPT_HTTPHEADER => array(
        'Authorization: key f02f30aad4874049af78d2a284c4e7ba',
        'Content-Type: application/json',
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    
    if(!empty($response)){
        $responseData = json_decode($response, true);

        if(isset($responseData['payment_url'])){
            $value = $responseData['payment_url'];
            echo $value;
            header("Location: $value");
        }else{
            echo "Payment url not found in response.";
        }
    }else{
        echo "Empty response received.";
    }
?>