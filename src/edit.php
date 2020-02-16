<?php

ini_set('display_errors', 1);
require_once 'models/APIClient.php';
require_once 'models/Product.php';
$product = new Product();

if (isset($_POST['buttonSave'])) {
    $_POST['status'] = isset($_POST['status']);
    $product->update($_POST);
    header('Location:index.php');
}

$result = $product->find($_GET['id']);
$product = json_decode($result['response']);
?>

<h3>Edit Product</h3>
<form method="post">
    <table>
        <tr>
            <td>Name</td>
            <td><input type="text" name="name" required="required"></td>
        </tr>
        <tr>
            <td>Price</td>
            <td><input type="number" name="price" required="required"></td>
        </tr>
        <tr>
            <td>Quantity</td>
            <td><input type="number" name="quantity" required="required"></td>
        </tr>
        <tr>
            <td>Status</td>
            <td><input type="checkbox" name="status" <?= $product->status ? 'active="active"' : 'inactive:"inactive"' ?></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="buttonSave"></td>
        </tr>
    </table>
</form>

