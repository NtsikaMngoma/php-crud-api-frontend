<?php

ini_set('display_errors', 1);
require_once 'models/APIClient.php';
require_once 'models/Product.php';
require_once 'layouts/header.php';

if (isset($_GET['id'])) {
    $product->delete($_GET['id']);
}
$result = $product->findAll();
$products = json_decode($result['response']);
?>
<h3>
    Product List
</h3>
<a href="add.php">Add Product</a>
<table border="1">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php foreach ($products as $product) { ?>
        <tr>
            <td><?=$product->id; ?></td>
            <td><?=$product->name; ?></td>
            <td><?=$product->price; ?></td>
            <td><?=$product->quantity; ?></td>
            <td><?=$product->status ? 'active' : 'inactive'; ?></td>
            <td>
                <a href="edit.php?id=<?= $product->id; ?>">Edit</a> |
                <a href="index.php?id=<?= $product->id; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

<?php require_once 'layouts/footer.php'; ?>
