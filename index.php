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
            <option value="daily">Daily</option>
            <option value="weekly">Weekly</option>
            <option value="monthly">Monthly</option>
        </select>

       <div id="tableContainer">
       
       </div>
       <button id='generatePdf' type='button' class='btn btn-outline-primary'>Generate PDF</button>
        <div class="rater">

        </div>
    </div>

    <!-- TRIAL Jquery for display table -->
    <script>
        $(document).ready(function () {
           
            updateTable();

            // Attach the updateTable function to the change event of the dropdown
            $('#period').change(updateTable);

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
                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                        }
                    });
            }

            $('#generatePdf').on('click', function () {
                var tableHtml = $('#myTable').prop('outerHTML');
                // alert(html);
             
        // Use AJAX to send the HTML content to the server for PDF generation
                $.ajax({
                    url: 'generatePdf.php',
                    method: 'POST',
                    data: {
                        htmlContent: tableHtml
                    },
                    success: function (data) {
                        
                        // Redirect to the generated PDF file
                        window.location.href = data.pdfUrl;
                        // alert(data);
                    },
                    error: function (error) {
                        console.error('Error generating PDF:', error);
                    }
                });
            });

        });
    </script>
</body>
</html>