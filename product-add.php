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

<div>
    
<form id="#product_form" action="form-handling.php" method="POST">
<div>
    <p>SKU: <input type="text" id="#sku" name="sku" required>
    <p>Name: <input type="text" id="#name" name="name"  required>
    <p>Price ($): <input type="number" id="#price" name="price"  required>

</div>
<div>

    <select name="type" id="#productType" onchange="adjustForm()" required>
    <option id="#type-switcher" value="">Select type</option>
    <option id="#DVD" value="DVD">DVD</option>
    <option id="#Book" value="Book">Book</option>
    <option id="#Furniture" value="Furniture">Furniture</option>
    </select>

    <div id="autoForm"></div>

    <script>
    function adjustForm() {
        var x = document.getElementById("#productType").value;
        var customForm = document.createElement('p');
        if (x === "0") {
            customForm.innerHTML = '<p><br></p>';
            document.getElementById("autoForm").replaceChildren(customForm);
            }
        else if (x === "DVD") {
            customForm.innerHTML = 
            '<p>Size (MB): <input type="number" id="#size" name="size" required></p><p>Please indicate size in megabytes.</p>';      
            document.getElementById("autoForm").replaceChildren(customForm);
        } else if (x === "Book") {
            customForm.innerHTML = 
            '<p>Weight (kg): <input type="number" id="#weight" name="weight" required></p><p>Please indicate weight in kilograms.</p>';
            document.getElementById("autoForm").replaceChildren(customForm);
        } else if (x === "Furniture") {
            customForm.innerHTML = 
            '<p>Height (cm): <input type="number" id="#height" name="height" required></p><p>Please indicate height in centimeters.</p><p>Width (cm): <input type="number" id="#width" name="width" required></p><p>Please indicate width in centimeters.</p><p>Length (cm): <input type="number" id="#length" name="length" required></p><p>Please indicate length in centimeters.</p>';
            document.getElementById("autoForm").replaceChildren(customForm);
        }
    }
    </script>
</div>
</form>
</div>
<?php include 'includes/footer.php'; ?>