<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'task';

$conn = mysqli_connect($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        http_response_code(500);
        echo ($conn->connect_error);
        die();
    }

    $url = $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $parts = parse_url($url);
    parse_str($parts['query'], $query);

    $limit = is_numeric($query['limit']) ? $query['limit'] : 100;
    $offset = is_numeric($query['offset']) ? $query['offset'] : 0;
    $filterCondition = $query['phoneExists'] == 'true' ? ' AND CUSTOMERS.phone IS NOT NULL' : '';

    
    $condition = is_numeric($query['id']) ? " AND CUSTOMERS.id='" . $query['id'] . "'" : "";

    $customersQuery = "SELECT *
    , CASE WHEN CUSTOMERS.sent_message IS NULL THEN 0 ELSE 1 END AS is_sms_sent FROM CUSTOMERS,ADDRESSES
    WHERE CUSTOMERS.id=ADDRESSES.customer_id" . $condition . $filterCondition . " LIMIT " . $offset . "," . $limit;
    $res = $con->query($customersQuery);

    $custArr = array();

    while ($row = $res->fetch_assoc()) {
        $address = new CustomerAddress($row['id'], $row['street_address'], $row['city'], $row['province'], $row['zip'], $row['country'], $row['country_code']);
        $cust = new Customer($row['customer_id'], $row['first_name'], $row['last_name'], $row['phone'], $row['email'], $row['is_sms_sent'], $address);
        array_push($custArr, $cust);
    }

    $filterCondition = substr($filterCondition, 4);
    $cond = $filterCondition == '' ? '' : ' WHERE' . $filterCondition;
    $customersCountQuery = "SELECT COUNT(*) as count FROM CUSTOMERS" . $cond;
    $res = $con->query($customersCountQuery);

    while ($row = $res->fetch_assoc()) {
        $totalCustomersCount = intval($row['count']);
    }

    $resp = array();
    $resp['customers'] = $custArr;
    $resp['customerCount'] = count($custArr);
    $resp['totalCustomersCount'] = $totalCustomersCount;
    echo ($resp);
    die();
    else {
    http_response_code(404);
    }
