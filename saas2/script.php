<?php


$sinceID = 0;

while (true) {
    $ch = curl_init('https://suyash131.myshopify.com/admin/customers.json?limit=250&since_id=' . $sinceID);
    curl_setopt($ch, CURLOPT_USERPWD, $_ENV['SHOPIFY_USER'] . ':' . $_ENV['SHOPIFY_PWD']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('content-type'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $res = curl_exec($ch);


    $customers = $res->customers;
    $customerCount = count($customers);

    foreach ($customers as $customer) {
        $customerQuery = "INSERT INTO CUSTOMERS values(" . wrapInSingleQuotes($customer->id) .
        "," . wrapInSingleQuotes($customer->first_name) .
        "," . wrapInSingleQuotes($customer->last_name) .
        "," . wrapInSingleQuotes($customer->phone) .
        "," . wrapInSingleQuotes($customer->email) .
            ",NULL)";
        if (!$con->query($customerQuery)) {
            echo ("Error: " . $customerQuery . $con->error);
        }
        $address = $customer->default_address;
        $addressQuery = "INSERT INTO ADDRESSES values("
        . wrapInSingleQuotes($address->id) .
        "," . wrapInSingleQuotes($address->address1) .
        "," . wrapInSingleQuotes($address->city) .
        "," . wrapInSingleQuotes($address->country) .
        "," . wrapInSingleQuotes($address->country_code) .
        "," . wrapInSingleQuotes($address->zip) .
        "," . wrapInSingleQuotes($address->customer_id) .
        "," . wrapInSingleQuotes($address->province) . ")";
        if (!$con->query($addressQuery)) {
            echo ("Error: " . $addressQuery . $con->error);
        }
    }
    $sinceID = $customers[$customerCount - 1]->id;
    if ($customerCount < 250) {
        break;
    }
}

echo ("Records saved successfully!");
