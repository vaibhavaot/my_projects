<?php include '../view/header.php'; ?>
<main>
    <h1>Add Product</h1>
    <session>
    <table>
    <form action="index.php" method="post" id="add_size_form">
        <input type="hidden" name="action" value="add_size">	
        
        <label>Size:</label>
        
        <input type="text" name="size_name" />
        
        <br>
        <br>
     	<label>&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &nbsp;</label>
        <input type="submit" value="Add Size" />
        
   		
   		<p class="last_paragraph">
    	<br>
    	<label>&emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &nbsp;</label>
        <a href="index.php?action=list_sizes">View Size List</a>
    </p>
     </table> 	
    </form>
    </session>

</main>
<?php include '../view/footer.php'; ?>
<label>&nbsp;</label>