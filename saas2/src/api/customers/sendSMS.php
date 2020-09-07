<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'task';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn) {
    die('Connection Failed: '.mysqli_connect_error());
}
    if ($conn->connect_error) {
        http_response_code(500);
        echo ($conn->connect_error);
        die();
    }
    $sql = "SELECT COUNT(*) as count FROM CUSTOMERS";
    $data = $conn->query($sql);
    
function wrapInSingleQuotes($val)
    {
        
        $val = str_replace("'", "''", $val);
        return $val ? "'" . $val . "'" : "NULL";
    }
    if (!$data->messageType || !($data->messageType == 'custom' || $data->messageType == 'promo' || $data->messageType == 'delivered' || $data->messageType == 'shipped')) {
        http_response_code(400);
        echo (array('error' => 'Invalid messageType, should be one of promo|delivered|shipped|custom'));
        die();
    } else if (!$data->customerID) {
        http_response_code(400);
        echo (array('error' => 'Invalid customerID, Please pass the customerID'));
        die();
    } else {
        if ($data->messageType == 'promo') {
            $message = 'Hi, use coupon OFF30 to get flat 30% off on all our range.';
        } else if ($data->messageType == 'delivered') {
            $message = 'Hi, your order with order no 123 was successfully delivered';
        } else if ($data->messageType == 'shipped') {
            $message = 'Hi, your order with order no 123 was successfully shipped';
        } else {
            $message = $data->message;
            if (!$message) {
                http_response_code(400);
                echo (json_encode(array('error' => 'Invalid message, need to pass message parameter with custom messageType')));
                die();
            }
        }
        $dbQuery = "UPDATE CUSTOMERS SET sent_message=" . wrapInSingleQuotes($message) . " WHERE id=" . wrapInSingleQuotes($data->customerID) . "AND phone IS NOT NULL";
        $res = $con->query($dbQuery);
        if (!res) {
            http_response_code(409);
            echo (array('error' => 'Can\'t send SMS, already sent'));
            die();
        } else {
            echo (array('message' => 'SMS sent successfully'));
            die();
        }
    }
?>
