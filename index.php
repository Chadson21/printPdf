<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Display</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid">
            <h2>Sales Data</h2>

            <label for="period"class="form-label">Select period:</label>
            <select id="period">
                <option value="all">All</option>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>

            <!-- table -->
        <div id="tableContainer">
        
        </div>
        
        <div class="d-flex justify-content-around align-items-center">
            <button id='generatePdf' type='button' class='btn btn-outline-primary'>Generate PDF</button>
            <div id="priceCon" class="d-flex justify-content-evenly align-items-center">
                <laber>Total Sales Price: </label>
                <h3 id="priceSum"></h3>
            </div>
        </div>
        
        <div class="d-flex justify-content-around">

            <form id="voucherForm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="voucherCode">Check Validity</label>
                        <input type="text" id="voucherCode" placeholder="Voucher Code">
                    </div>
                </div>
            </form>
            <!-- // Assume you have a button with ID 'generateVoucherBtn' and a div with ID 'voucherDisplay' -->
        <!--trigger Voucher modal -->

            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                    Create Voucher
                    </button>
            </div>
            
        </div>
    </div>

   
   

    <!-- Modal for Creating Voucher-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Discount Vouchers</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body">
                <!-- haynako -->
                <div>
                    <p>
                      <i id="voucherSavingInfo"></i>  
                    </p>
                </div>
                <label for="voucherDisplay">Voucher Code</label>
                <div class="input-group mb-3 ">
                   
                    <input type="text"  id="voucherDisplay" placeholder="Voucher Code" aria-label="Recipient's username" aria-describedby="button-addon2" disabled readonly>
                   
                    <div class="input-group-append">
                        <button id="generateVoucherBtn" class="btn btn-outline-secondary" type="button" id="button-addon2" >Generate Code</button>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="discount" class="">Discount</label>
                        <input type="number"  min="1" class="form-control" id="discount" placeholder="0.00%" aria-label="Discount">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="expDate" class="">Expiry Date</label>
                        <input type="date" class="form-control" id="expDate" placeholder="Select Expiry Date" aria-label="Expiration Date">
                    </div>
                </div>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveVoucher">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TRIAL Jquery for display table -->
    <script>
        $(document).ready(function () {
            $('#myModal').on('shown.bs.modal', function () {
                 $('#myInput').trigger('focus');
            })
           
            updateTable();
            // Attach the updateTable function to the change event of the dropdown
            $('#period').change(updateTable());

            function updateTable() {
                var selectedPeriod = $('#period').val();

                    // Use jQuery to make an AJAX request to fetch data
                    $.ajax({
                        url: 'get_sales_data.php',
                        method: 'GET',
                        data: { period: selectedPeriod },
                        dataType: 'json',
                        success: function(response) {
                            // Insert the HTML table into the specified container
                            $('#tableContainer').html(response.tableHTML);
                            calculateSum();

                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                   
            }

            $('#generatePdf').on('click', function () {
                var tableHtml = $('#myTable').prop('outerHTML');
                var priceCon  = $('#priceSum').text();
                // var selectedPeriod = $('#period').val();

             // Use AJAX to send the HTML content to the server for PDF generation
                $.ajax({
                    url: 'generatePdf.php',
                    method: 'POST',
                    data: {
                        htmlContent: tableHtml,
                        priceCon:priceCon,
                        // selectedPeriod:period
                    },
                    success: function (data) {
                        $('#priceCon').append(data); 
                       window.open('seabreak.pdf');
                    },
                    error: function (error) {
                        console.error('Error generating PDF:', error);
                    }
                });
            });

            function calculateSum(){
                var sum = 0;

                // Iterate over each row in the table body
                $("#myTable tbody tr").each(function() {
                    
                    // Get the text content of the third cell (index 2) in the current row
                    var cellText = $(this).find("td:eq(4)").text();
                    // Convert the text to a number and add it to the sum
                    var cellValue = parseFloat(cellText);
                        if (!isNaN(cellValue)) {
                            sum += cellValue;
                        }
                });

                // Display the sum
                $('#priceSum').html('Php '+ sum.toFixed(2));
            }

            $('#voucherForm').submit(function(event) {
                event.preventDefault();
                
                // Get the voucher code from the input field
                var voucherCode = $('#voucherCode').val();
                
                // Send AJAX request to the backend API
                $.ajax({
                    url: 'voucher.php', // Replace with the actual path to your PHP file
                    method: 'POST',
                    data: { voucherCode: voucherCode },
                    dataType: 'json',
                    success: function(response) {
                        // Handle the response from the server
                        if (response.valid) {
                            alert('Voucher is valid! Discount: ' + response.discount);
                        } else {
                            alert('Invalid voucher code. Please try again.');
                        }
                    },
                    error: function() {
                        alert('Error checking voucher. Please try again later.');
                    }
                });
            });

            $('#generateVoucherBtn').click(function() {
                // Send AJAX request to the backend API to generate a voucher code
                $.ajax({
                    url: 'voucher.php', // Replace with the actual path to your PHP file
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Display the generated voucher code on the webpage
                        $('#voucherDisplay').val(response.voucherCode);
                        // alert(response.voucherCode);
                    },
                    error: function() {
                        alert('Error generating voucher code. Please try again later.');
                    }
                });
            });

            $('#saveVoucher').click(function(){
              
                var code = $('#voucherDisplay').val();
                var discount = $('#discount').val();
                var expDate = $('#expDate').val();
                
                alert(code+" "+discount+" "+expDate);

                $.ajax({
                    url: 'saveVoucher.php', 
                    method: 'POST',
                    data: {
                         code: code,
                         discount: discount,
                         expDate: expDate

                        },
                    dataType: 'json',
                    success: function(response) {
                        
                       alert(response);
                        // alert(response.voucherCode);
                    },
                    error: function(response) {
                        alert(response);
                    }
                });
            });

            $('#discount').on('input', function () {
                // Get the current value of the input
                var inputValue = $(this).val();

                // Check if the value is a number and greater than or equal to 0
                if (!!inputValue && Math.abs(inputValue) >= 1) {
                    // Update the input value with its absolute value
                    $(this).val(Math.abs(inputValue));
                } else {
                    // Set the input value to null if the condition is not met
                    $(this).val(null);
                }
            });
            

 });
    </script>

</body>
</html>