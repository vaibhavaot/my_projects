<?php include '../view/header.php'; ?>
<main>
<session>
	
    <h1>Add Topping</h1>
    <form action="index.php" method="post" id="add_topping_form">
        <input type="hidden" name="action" value="add_topping">
        <br>
        <br>
        
       		<label>&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &nbsp;</label>
        	<label>Topping Name:</label>
        	
        	<input type="text" name="topping_name" />
        	<br>
        	
        	<br>
        	<label>&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &nbsp;</label>
        	<label>&nbsp;</label>
       		<input type="submit" value="Add" />
        	<br>
       		</form>
	
    <p class="last_paragraph">
    <label>&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &nbsp;</label>
        <a href="index.php?action=list_toppings">View Topping List</a>
    </p>
</session>
</main>
<?php include '../view/footer.php'; ?>