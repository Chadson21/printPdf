<?php
    
    // Assuming you have a database connection established

    // Function to check voucher validity
    function checkVoucherValidity($voucherCode) {
        include_once "connection.php";
        // Add proper validation and sanitization to $voucherCode to prevent SQL injection
        
        // Query the database to check if the voucher code is valid and not expired
        $query = "SELECT * FROM voucher WHERE voucher_code = '$voucherCode' AND expiration_date >= NOW()";
        $result = mysqli_query($con, $query);
        
        if ($result) {
            // Check if any rows are returned
            if (mysqli_num_rows($result) > 0) {
                // Voucher is valid
                $voucherData = mysqli_fetch_assoc($result);
                return array('valid' => true, 'discount' => $voucherData['discount']);
            } else {
                // Voucher code not found or expired
                return array('valid' => false);
            }
        } else {
            // Error in the database query
            return array('error' => 'Database error');
        }
    }

    

    function generateVoucherCode() {
        $characters = 'aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ0123456789';
        $voucherCode = '';
        $codeLength = 8; // change to Adjust the lenght
    
        for ($i = 0; $i < $codeLength; $i++) {
            $voucherCode .= $characters[rand(0, strlen($characters) - 1)];
        }
    
        return $voucherCode;
    }

   
    
    // Generate a voucher code if a GET request is received
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $newVoucherCode = generateVoucherCode();
        echo json_encode(array('voucherCode' => $newVoucherCode));
    }

    // Check voucher validity if a POST request is received
    if (isset($_POST['voucherCode'])) {
        $voucherCode = $_POST['voucherCode'];
        $result = checkVoucherValidity($voucherCode);
        echo json_encode($result);
    }
    
    
?>