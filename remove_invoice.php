<?php
include_once('connection.php');
include_once('header.php');

$invoice_id = $_GET['invoice_item_id'];

try {
    $stmt = $dbcon->prepare("DELETE FROM invoice_items WHERE invoiceId = :invoice_item_id");
    $stmt->bindParam(':invoice_item_id', $invoice_id);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
