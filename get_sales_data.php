<?php




$period = $_GET['period'];
include("connection.php");
// Define start and end dates based on the selected period
if ($period == 'daily') {
    $start = date('Y-m-d');
    $end = date('Y-m-d');
    $query  = "SELECT transaction_number, product_name, size, quantity, price, order_date, emp_name FROM orders WHERE order_date BETWEEN '$start' AND '$end'";
} elseif ($period == 'weekly') {
    $start = date('Y-m-d', strtotime('last Sunday'));
    $end = date('Y-m-d', strtotime('next Saturday'));
    $query  = "SELECT transaction_number, product_name, size, quantity, price, order_date, emp_name FROM orders WHERE order_date BETWEEN '$start' AND '$end'";
} elseif ($period == 'monthly') {
    $start = date('Y-m-01');
    $end = date('Y-m-t');
    $query  = "SELECT transaction_number, product_name, size, quantity, price, order_date, emp_name FROM orders WHERE order_date BETWEEN '$start' AND '$end'";
} elseif($period == 'all'){
    $query  = "SELECT transaction_number, product_name, size, quantity, price, order_date, emp_name FROM orders";
}

// Fetch data from the table for the specified period

$result = $con->query($query);

// Create HTML table
$tableHTML = "<table id='myTable'class='table table-responsive'  cellspacing=3'>";
$tableHTML .= "<thead><tr><th>Transaction Number</th><th>Product Name</th><th>Size</th><th>Qty</th><th>Price</th><th>Date</th><th>Employee</th></tr></thead>";

while ($row = $result->fetch_assoc()) {

    $tableHTML .= "<tbody>";
    $tableHTML .= "<tr>";
    $tableHTML .= "<td>{$row['transaction_number']}</td>";
    $tableHTML .= "<td>{$row['product_name']}</td>";
    $tableHTML .= "<td>{$row['size']}</td>"; 
    $tableHTML .= "<td>{$row['quantity']}</td>"; 
    $tableHTML .= "<td>".number_format($row['price'],2)."</td>"; 
    $tableHTML .= "<td>{$row['order_date']}</td>"; 
    $tableHTML .= "<td>{$row['emp_name']}</td>"; 
    $tableHTML .= "</tr>";
    $tableHTML .= "</tbody>";
}

$tableHTML .= "</table>";

// Send the HTML table as JSON response
header('Content-Type: application/json');
echo json_encode(['tableHTML' => $tableHTML]);

// Close the connection
$con->close();
?>