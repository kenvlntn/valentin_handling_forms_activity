<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Discriminant Calculator</title>
</head>
<body>
    <form method="post">
        <label for="a">Value of a:</label>
        <input type="number" name="a" id="a" step="any" required>
        <br><br>
        
        <label for="b">Value of b:</label>
        <input type="number" name="b" id="b" step="any" required>
        <br><br>
        
        <label for="c">Value of c:</label>
        <input type="number" name="c" id="c" step="any" required>
        <br><br>
        
        <input type="submit" name="submit" value="Calculate">
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // Retrieve inputs
        $a = $_POST['a'];
        $b = $_POST['b'];
        $c = $_POST['c'];

        // Calculate discriminant: b^2 - 4ac
        $discriminant = ($b * $b) - (4 * $a * $c);

        // Display result
        echo "<br>The discriminant is: " . $discriminant;
    }
    ?>
</body>
</html>