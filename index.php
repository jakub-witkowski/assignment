<?php
include 'Product.php';
include 'db-connect.php';

$discs = $db_pdo->query("SELECT sku, name, price, size FROM products WHERE type='dvd'")->fetchAll(PDO::FETCH_CLASS, 'Disc');
$books = $db_pdo->query("SELECT sku, name, price, weight FROM products WHERE type='book'")->fetchAll(PDO::FETCH_CLASS, 'Book');
$chairs = $db_pdo->query("SELECT sku, name, price, height, width, length FROM products WHERE type='furniture'")->fetchAll(PDO::FETCH_CLASS, 'Chair');

$db_pdo = NULL; 

$available_products = array_merge($discs, $books, $chairs);

?>

<?php include 'includes/header.php'; ?>

<div class="container">
    <h1>Product list</h1>
    <div class="button-container">
    <button class="button" onclick="window.location.href='product-add.php';">Add</button>
    <button class="button" id="#delete-product-btn" onclick="removeCheckedCheckboxes()">Mass delete</button>
</div>

</div>

<div id="grid">
<?php foreach ($available_products as $product): 
    echo '<div class="cell"><br>';
    echo '<input type="checkbox" class="delete-checkbox"><br><p>';
    printf("%s", $product->get_sku());
    echo '<br>';
    printf("%s", $product->getName());
    echo '<br>';
    printf("%.2f $", $product->getPrice());
    echo '<br>';
    $product->print_attributes();
    echo '</p></div>'; 
endforeach;
    ?>
</div>

<script>
function removeCheckedCheckboxes() {
  var list = document.getElementsByTagName('input');
  for (var i = 0; i < list.length; ++i) {
    var product = list[i];
    if (product.checked)
      product.parentElement.hidden = true;
  }
}
</script>

<?php include 'includes/footer.php'; ?>