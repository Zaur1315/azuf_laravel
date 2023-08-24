<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из POST-запроса и декодируем из JSON
    $data = $_POST;

    // Проверяем, были ли получены POST-данные
    if (empty($data)) {
        // Если POST-данные не были получены, выводим сообщение и записываем его в файл
        $message = "No POST data received1";
        echo $message;
        // file_put_contents("data.txt", $data, FILE_APPEND);
    } else {
        // Если POST-данные были получены, записываем их в файл
        $message = json_encode($data);
        // file_put_contents("data.txt", $message, FILE_APPEND);

        // if ($data['status'] == 'success' and $data['type'] == 'sale'){
             if ($data['status'] == 'success'){

            $publicID = $data['id'];
            $order_num = $data['order_number'];
            $order_amount = $data['order_amount'];
            $order_status = $data['status'];
            $card = $data['card'];
            $date = $data['date'];
            $customer_name = $data['customer_name'];
            $customer_email = $data['customer_email'];
            $customer_ip = $data['customer_ip'];
            $first_name = $data["customer_city"];
            $last_name = $data['customer_state'];
            $phone = $data['customer_address'];
            $fin = $data ['order_description'];

            // $sss = "\n$publicID\n$order_num\n$order_amount\n$order_status\n$card\n$date\n$customer_name\n$customer_email\n$customer_ip\n$last_name\n$first_name\n$phone\n$fin\n";
            // file_put_contents("data.txt", 'SUCCESS', FILE_APPEND);
            // file_put_contents("data.txt", $sss."урааа", FILE_APPEND);


            $servername = "localhost";
            $username = "exezine_azuf_usr";
            $password = "7264329466694z";
            $dbname = "exezine_azuf";


            $conn = mysqli_connect($servername, $username, $password, $dbname);



            // Проверяем соединение
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                file_put_contents("data.txt", 'CANT CONNECT TO DB', FILE_APPEND);
            }

            mysqli_set_charset($conn, "utf8mb4");
            $sql = "INSERT INTO azuf ( publicID, order_num, order_amount, order_status, card, date, card_name, customer_email, customer_ip, first_name, last_name, phone, 	fin  ) VALUES ( '".mysqli_real_escape_string($conn, $publicID)."','".mysqli_real_escape_string($conn, $order_num)."','".mysqli_real_escape_string($conn, $order_amount)."','".mysqli_real_escape_string($conn, $order_status)."','".mysqli_real_escape_string($conn, $card)."','".mysqli_real_escape_string($conn, $date)."','".mysqli_real_escape_string($conn, $customer_name)."','".mysqli_real_escape_string($conn, $customer_email)."','".mysqli_real_escape_string($conn, $customer_ip)."','".mysqli_real_escape_string($conn, $first_name)."','".mysqli_real_escape_string($conn, $last_name)."','".mysqli_real_escape_string($conn, $phone)."','".mysqli_real_escape_string($conn, $fin)."' )";
            
            
            function get_data(){
                date_default_timezone_set('Asia/Baku');
                $current_time = date('H:i:s, d-m-Y');
                return $current_time;
            }
        
        try {
            if (mysqli_query($conn, $sql)) {
                $i = get_data();
            file_put_contents("data.txt", "\n$i - Public Id $publicID saved successfully in MySQL database", FILE_APPEND);
            } else {
                 $i = get_data();
                file_put_contents("data.txt", "\n$i - Error", FILE_APPEND);
            }
        } catch (Exception $e) {
             $i = get_data();
            file_put_contents("data.txt", "\n$i - Error: " . $e->getMessage(), FILE_APPEND);
        }
            
            
            // if (mysqli_query($conn, $sql)) {
            //     // file_put_contents("data.txt", "Data saved successfully in MySQL database", FILE_APPEND);
            // } else {
            //     file_put_contents("data.txt", "Error", FILE_APPEND);
            // }
            
            
            
            mysqli_close($conn);
        }
            
        // }else{
        //     file_put_contents("data.txt", $data['type'], FILE_APPEND);
        // }

    }
} else {
    // Если запрос не является POST-запросом, выводим сообщение и записываем его в файл
    $message = "No POST data received2";
    echo $message;
    file_put_contents("data.txt", $message, FILE_APPEND);
}
?>