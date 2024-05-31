<?php include ("dbconfig.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Create</title>
    <link rel="stylesheet" href="invoice.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
        
            <!-- start print button -->
            <a href="#" onclick="window.print()"
                style="margin:20px;display: inline-block; padding: 10px 20px; background-color: #28a745; color: #fff; text-decoration: none; border-radius: 5px;">Generate
                Invoice</a>
                <!-- end print button -->
               
        
            <h1>GENX ELECTRICAL AND I.T. SOLUTIONS</h1>
            <h2>Bhaktapur, Nepal</h2>
            <h3>9849423497, 9823552180</h3>

            <form>
                <h4><label for="bill_number">Bill Number:</label><br>
                <input type="text" id="bill_number" name="bill_number"><br>

                <label for="pan_number">PAN Number:</label><br>
                <input type="text" id="pan_number" name="pan_number" value="618664238"><br></h4>

                <h5><label for="created_at">Date:</label>
                <input type="date" readonly id="created_at" name="created_at"><br><br></h5>

                <?php
                $sql = "SELECT * FROM sell_products WHERE invoice_id ='" . $_GET['invoice_id'] . "'";
                $result = $conn->query($sql);
                $customerDetails = null;
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $customerDetails = $row;
                    }
                }
                ?>

                <?php
                $sql = "SELECT * FROM invoices WHERE id ='" . $_GET['invoice_id'] . "'";
                $invoiceResult = $conn->query($sql);
                $invoiceData = null;
                if ($invoiceResult->num_rows > 0) {
                    while ($row = $invoiceResult->fetch_assoc()) {
                        $invoiceData = $row;
                    }
                }
                ?>

                <label for="customer_name">Customer Name:</label>
                <input type="text" readonly id="customer_name" value="<?php echo $customerDetails['customer_name']; ?>"><br><br>

                <label for="customer_address">Customer Address:</label>
                <input type="text" readonly id="customer_address" value="<?php echo $customerDetails['customer_address']; ?>"><br><br>

                <label for="customer_number">Customer Number:</label>
                <input type="text" readonly id="customer_number" value="<?php echo $customerDetails['customer_number']; ?>"><br><br>

                <table class="table" width="60%" align="center">
                    <tr>
                        <th>SN</th>
                        <th>Particulars</th>
                        <th>Qty.</th>
                        <th>Rate</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="SN[]"></td>
                        <td><input type="text" name="particulars[]"></td>
                        <td><input type="text" name="quantity[]" oninput="calculateAmount(this)"></td>
                        <td><input type="text" name="rate[]" oninput="calculateAmount(this)"></td>
                        <td><input type="text" name="amount[]" readonly></td>
                    </tr>
                    <!-- Additional rows will be added here -->
                </table>

                <button type="button" id="addRowButton">Add More</button>

                <div>
                    <label for="discount_percent">Discount(%):</label>
                    <input type="number" id="discount_percent" name="discount_percent" oninput="calculateGrandTotal()" value="<?php echo $invoiceData['discount_percent']; ?>"><br><br>
                </div>

                <div>
                    <label for="total">Total:</label>
                    <input type="text" id="total" name="total" value="<?php echo $invoiceData['total'] ?>" readonly><br><br>
                </div>

                <p>*Goods once sold are not returnable.*</p>
                <p>*E. & O.E</p>

                <div class="footer-section">
                    <div>
                        <p>Received by:</p>
                        <div class="signature"></div>
                    </div>
                    <div>
                        <p>Signature:</p>
                        <div class="signature"></div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function calculateAmount(input) {
            var row = input.closest('tr');
            var quantity = row.querySelector('input[name="quantity[]"]').value;
            var rate = row.querySelector('input[name="rate[]"]').value;
            var amount = parseFloat(quantity) * parseFloat(rate);
            row.querySelector('input[name="amount[]"]').value = isNaN(amount) ? "" : amount.toFixed(2);
            calculateGrandTotal();
        }

        function calculateGrandTotal() {
            var amounts = document.querySelectorAll('input[name="amount[]"]');
            var subtotal = 0;
            amounts.forEach(function (input) {
                subtotal += parseFloat(input.value) || 0;
            });
            var discountPercent = parseFloat(document.getElementById('discount_percent').value) || 0;
            var total = subtotal - (subtotal * (discountPercent / 100));
            document.getElementById('total').value = total.toFixed(2);
            convertNumberToWords(total);
        }

        function convertNumberToWords(amount) {
            var words = ["Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
            var tens = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
            amount = amount.toFixed(2).split(".");
            var num = parseInt(amount[0]);
            var dec = parseInt(amount[1]);
            var numWords = "";

            if (num > 19) {
                numWords += tens[Math.floor(num / 10)] + " " + words[num % 10];
            } else {
                numWords += words[num];
            }
            if (dec > 0) {
                numWords += " and " + words[dec] + " Cents";
            }
            document.getElementById('amount_in_words').value = numWords + " Only";
        }

        document.getElementById('addRowButton').addEventListener('click', function () {
            var table = document.querySelector('table');
            var newRow = table.insertRow();
            newRow.innerHTML = `
                <td><input type="text" name="SN[]"></td>
                <td><input type="text" name="particulars[]"></td>
                <td><input type="text" name="quantity[]" oninput="calculateAmount(this)"></td>
                <td><input type="text" name="rate[]" oninput="calculateAmount(this)"></td>
                <td><input type="text" name="amount[]" readonly></td>
            `;
        });

        function generateInvoice() {
            document.getElementById('generateInvoiceButton').style.display = 'none';
            window.print();
        }
    </script>

</body>

</html>

<?php
// Close connection
$conn->close();
?>
