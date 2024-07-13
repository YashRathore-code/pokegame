<?php
$host = 'localhost'; // Assuming your database is hosted locally
$dbname = 'indiawin_flw';
$username = 'indiawin_flw';
$password = 'indiawin_flw';

try {
    // Create a new PDO instance
    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);

    // Start the transaction
    $pdo->beginTransaction();

    // First query: Update the balance by adding the bonus where bonus is greater than 0
    $sql1 = "UPDATE users SET balance = balance + bonus WHERE bonus > 0";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->execute();

    // Second query: Set the bonus to 0 where bonus is greater than 0
    $sql2 = "UPDATE users SET bonus = 0 WHERE bonus > 0";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute();

    // Commit the transaction
    $pdo->commit();

    echo "Balance updated and bonus reset successfully.";
} catch (PDOException $e) {
    // Rollback the transaction if something failed
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
?>
