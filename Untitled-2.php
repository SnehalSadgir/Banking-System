<!DOCTYPE html>
<html>
<head>
    <title>Transfer Money</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Transfer Money</h1>
        <form method="POST" action="transfer.php">
            <label for="sender">Sender:</label>
            <select id="sender" name="sender">
                <?php
                // Connect to the database
                $conn = mysqli_connect("localhost", "username", "password", "banking_system");

                // Query the database for all customers
                $result = mysqli_query($conn, "SELECT * FROM customers");

                // Loop through each row of the result and display it in a dropdown option
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=\"" . $row["id"] . "\">" . $row["name"] . "</option>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </select>
            <br>
            <label for="receiver">Receiver:</label>
            <select id="receiver" name="receiver">
                <?php
                // Connect to the database
                $conn = mysqli_connect("localhost", "username", "password", "banking_system");

                // Query the database for all customers
                $result = mysqli_query($conn, "SELECT * FROM customers");

                // Loop through each row of the result and display it in a dropdown option
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=\"" . $row["id"] . "\">" . $row["name"] . "</option>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </select>
            <br>
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" required>
            <br>
            <button type="submit">Transfer</button>
        </form>
    </div>
</body>
</html>




<?php
// Get the form inputs
$sender = $_POST["sender"];
$receiver = $_POST["receiver"];
$amount = $_POST["amount"];

// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "banking_system");

// Get the sender and receiver details from the database
$sender_result = mysqli_query($conn, "SELECT * FROM customers WHERE id=$sender");
$sender_row = mysqli_fetch_assoc($sender_result);
$receiver_result = mysqli_query($conn, "SELECT * FROM customers WHERE id=$receiver");
$receiver_row = mysqli_fetch_assoc($receiver_result);

// Check if the sender has sufficient balance for the transfer
if ($sender_row["balance"] >= $