<?php
 function saveVoucherCode($code, $discount, $expirationDate) {
    include_once "connection.php";
    
    
    // Add proper validation and sanitization to $code, $discount, and $expirationDate to prevent SQL injection

    // SQL query to insert the voucher into the 'vouchers' table
    $query = "INSERT INTO voucher (voucher_code, discount, expiration_date) VALUES ('$code', '$discount', '$expirationDate')";

    if ($con->query($query) === TRUE) {
        return true; // Voucher saved successfully
    } else {
        return false; // Error saving voucher
    }
}

if (isset($_POST['code'])) {
    $generatedCode = $_POST['code'];
    $discountAmount =  $_POST['discount'];
    $expirationDate = $_POST['expDate'];

    if (saveVoucherCode($generatedCode, $discountAmount, $expirationDate)) {
        echo "Voucher saved successfully!";
    } else {
        echo "Error saving voucher.";
    }

}



?>