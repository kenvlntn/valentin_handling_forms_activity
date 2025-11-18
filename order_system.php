<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        /* General Styles */
        body {
            margin: 20px;
        }

        /* --- MENU VIEW STYLES (Times New Roman) --- */
        .menu-view {
            font-family: 'Times New Roman', Times, serif;
        }
        .menu-view h1 {
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 15px;
        }
        /* Table styling to match the "double border" look in the screenshot */
        table {
            border: 1px solid black;
            margin-bottom: 20px;
            font-size: 1.2em;
        }
        th {
            font-weight: bold;
            text-align: center;
            padding: 5px 20px;
        }
        td {
            padding: 5px 20px;
        }
        /* Form styling */
        .form-group {
            font-size: 1.3em;
            margin-bottom: 15px;
        }
        select, input {
            font-size: 0.9em;
            padding: 2px;
        }
        button {
            font-size: 0.9em;
            padding: 2px 15px;
            background-color: #f0f0f0;
            border: 1px solid #767676;
            cursor: pointer;
            border-radius: 2px;
        }
        button:hover {
            background-color: #e0e0e0;
        }

        /* --- RECEIPT VIEW STYLES (Arial/Sans-Serif) --- */
        .receipt-view {
            font-family: Arial, Helvetica, sans-serif;
            border: 1px dotted black;
            padding: 20px 50px;
            display: inline-block;
            min-width: 350px;
        }
        .receipt-view h2 {
            text-align: center;
            text-transform: uppercase;
            margin-top: 10px;
            margin-bottom: 30px;
            font-size: 2em;
        }
        .receipt-line {
            font-weight: bold;
            font-size: 1.8em;
            margin-bottom: 15px;
        }
        .receipt-date {
            font-weight: bold;
            font-style: italic;
            font-size: 1.6em;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<?php
// Define Menu Prices
$prices = [
    "Burger" => 50,
    "Fries" => 75,
    "Steak" => 150
];

if (isset($_POST['submit'])) {
    // --- LOGIC FOR RECEIPT ---
    $order = $_POST['order'];
    $quantity = (int)$_POST['quantity'];
    $cash = (int)$_POST['cash']; // Using int to match whole numbers in image

    $total_price = $prices[$order] * $quantity;
    $change = $cash - $total_price;

    // Get current date/time in specific format: 09/25/2024 12:59:00 pm
    date_default_timezone_set('Asia/Manila'); // Adjust if needed
    $date_string = date("m/d/Y h:i:s a");

    // --- RECEIPT VIEW HTML ---
    ?>
    <div class="receipt-view">
        <h2>Receipt</h2>
        
        <div class="receipt-line">Total Price: <?php echo $total_price; ?></div>
        <div class="receipt-line">You Paid: <?php echo $cash; ?></div>
        <div class="receipt-line">CHANGE: <?php echo $change; ?></div>
        
        <div class="receipt-date"><?php echo $date_string; ?></div>
    </div>
    <?php

} else {
    // --- MENU / FORM VIEW HTML ---
    ?>
    <div class="menu-view">
        <h1>Menu</h1>

        <table border="1" cellspacing="1" cellpadding="3">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Burger</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td>Fries</td>
                    <td>75</td>
                </tr>
                <tr>
                    <td>Steak</td>
                    <td>150</td>
                </tr>
            </tbody>
        </table>

        <form method="post">
            <div class="form-group">
                <label>Select an order</label>
                <select name="order">
                    <option value="Burger">Burger</option>
                    <option value="Fries">Fries</option>
                    <option value="Steak">Steak</option>
                </select>
            </div>

            <div class="form-group">
                <label>Quantity</label>
                <!-- Removed default value so user can type '2' as shown in image -->
                <input type="text" name="quantity" required>
            </div>

            <div class="form-group">
                <label>Cash</label>
                <!-- Type number handles the up/down arrows shown in image -->
                <input type="number" name="cash" required>
            </div>

            <button type="submit" name="submit">Submit</button>
        </form>
    </div>
    <?php
}
?>

</body>
</html>