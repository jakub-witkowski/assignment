<?php
include 'includes/header.php'; 
include 'db-connect.php';
?>

<div class="container">
<div class="button-container">
    <button class="button" type="submit" form="#product_form">Save</button>
    <button class="button" onclick="window.location.href='index.php';">Cancel</button>
</div>
<h1>Product Add</h1>
</div>

<!--<div>-->
    
<form id="#product_form" action="form-handling.php" method="POST">
<!--<div>-->
    <div class="form">
        <label for="sku" class="title">SKU:</label>
        <input type="text" id="#sku" name="sku" required />
    </div>
    <div class="form">
        <label for="name" class="title">Name:</label>
        <input type="text" id="#name" name="name" required />
    </div>
    <div class="form">
        <label for="price" class="title">Price ($):</label>
        <input type="number" id="#price" name="price" required />
    </div>
<!--</div>-->
<div>
    <div class="form">
        <label for="type" class="title">Type:</label>
        <select name="type" id="#productType" onchange="adjustForm()" required>
        <option id="#type-switcher" value="">Select type</option>
        <option id="#DVD" value="DVD">DVD</option>
        <option id="#Book" value="Book">Book</option>
        <option id="#Furniture" value="Furniture">Furniture</option>
        </select>
        <p class="instruction">Please specify product type</p>
    </div>
    
    <div id="#autoForm"></div>

    <script>
    function adjustForm() {
        var x = document.getElementById("#productType").value;
        var customForm = document.createElement('div');
        if (x === "0") {
            customForm.innerHTML = '<div class="form"></div>';
            document.getElementById("#autoForm").replaceChildren(customForm);
            }
        else if (x === "DVD") {
            customForm.innerHTML = 
            '<div class="form"><label for="size" class="title">Size (MB):</label><input type="number" id="#size" name="size" required /><p class="instruction">Please indicate size in megabytes.</p></div>';      
            document.getElementById("#autoForm").replaceChildren(customForm);
        } else if (x === "Book") {
            customForm.innerHTML = 
            '<div class="form"><label for="weight" class="title">Weight (kg):</label><input type="number" id="#weight" name="weight" required /><p class="instruction">Please indicate weight in kilograms.</p></div>';
            document.getElementById("#autoForm").replaceChildren(customForm);
        } else if (x === "Furniture") {
            customForm.innerHTML = 
            '<div class="form"><label for="height" class="title">Height (cm):</label><input type="number" id="#height" name="height" required /><p class="instruction">Please indicate height in centimeters.</p><label for="width" class="title">Width (cm):</label><input type="number" id="#width" name="width" required /><p class="instruction">Please indicate width in centimeters.</p><label for="length" class="title">Length (cm):</label><input type="number" id="#length" name="length" required /><p class="instruction">Please indicate length in centimeters.</p></div>';
            document.getElementById("#autoForm").replaceChildren(customForm);
        }
    }
    </script>
</div>
</form>
<!--</div>-->
<?php include 'includes/footer.php'; ?>