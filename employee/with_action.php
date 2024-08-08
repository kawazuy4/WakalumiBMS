<?php
session_start(); // Start the session

include '../conn.php'; // Include the database connection

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    $_SESSION["status"] = "Tolong login dengan akun anda"; // Set status message
    $_SESSION["code"] = "warning"; // Set status code
    header("location: ../index.php"); // Redirect to login page
    exit; // Exit the script
}

// Check if the withdraw form is submitted
if (isset($_POST['transfer'])) {
    $name = $_POST['name']; // Get the name from the form
    $acc = $_POST['acc']; // Get the account number from the form
    $email = $_POST['email']; // Get the email from the form
    $title = $_POST['title']; // Get the title from the form
    $blnc = $_POST['blnc']; // Get the current balance from the form
    $newbnc = $_POST['amount']; // Get the withdrawal amount from the form
    $bnc1 = $blnc - $newbnc; // Calculate the new balance after withdrawal

    // Check if the withdrawal amount is less than the current balance and the balance is more than 500
    if ($newbnc < $blnc || $blnc > 500) {
        // Update the account balance in the database
        $query = "UPDATE accounts_info SET balance='$bnc1' WHERE account='$acc'";
        $rs1 = mysqli_query($con, $query); // Execute the query

        // Check if the update query was successful
        if ($rs1) {
            // Set the timezone and get the current date and time
            date_default_timezone_set('Asia/Jakarta');
            $regisdate = date("Y-m-d"); // Get current date
            $tms = date("h:i:s"); // Get current time
            $tms1 = date("Y-m-d h:i:s"); // Get current timestamp

            // Insert the withdrawal transaction into the account history
            mysqli_query($con, "INSERT INTO account_history(account, sender, s_name, receiver, r_name, dt, tm, type, amount) VALUES('$acc', '$acc', '$name', 'null', 'null', '$regisdate', '$tms', 'Ditarik', '$newbnc')");

            // Set success message and redirect to withdraw page
            $_SESSION["title"] = "Done";
            $_SESSION["status"] = "Tarik Tunai Berhasil";
            $_SESSION["code"] = "success";
            header("location: withdraw.php");
            exit; // Exit the script
        } else {
            // Set error message and redirect to withdraw page if the update query failed
            $_SESSION["title"] = "Error";
            $_SESSION["status"] = "Tarik Tunai Gagal";
            $_SESSION["code"] = "error";
            header("location: withdraw.php");
            exit; // Exit the script
        }
    } else {
        // Set error message and redirect to withdraw page if the balance is too low
        $_SESSION["title"] = "Error";
        $_SESSION["status"] = "Saldo Tidak Cukup";
        $_SESSION["code"] = "error";
        header("location: withdraw.php");
        exit; // Exit the script
    }
}
?>
