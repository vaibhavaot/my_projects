<?php include '../view/header.php'; ?>
<main>
    <section>
    <h1>Welcome to the Pizza Shop</h1>
    <h2>Pizza Size:</h2>
    
    <form  action="index.php" method="get">
        <input type="hidden" name="action" value="add_order"/>
                   
                   <?php foreach ($sizes as $size) : ?>
                       <input type="radio" name="pizza_size" 
                       	    value="<?php echo $size['size']; ?>">
                       		<?php echo $size['size']; ?>
						</input>              
                  <?php endforeach; ?>

 		<!-- 
<input type="radio" name="pizza_size" value="huge">huge</input>
        <input type="radio" name="pizza_size" value="small">small</input>
 -->

        <h3>Toppings:</h3>
            
            
      <?php foreach ($toppings as $topping) : ?>
                 <input type="checkbox" name="pizza_topping[]" 
                            value="<?php echo $topping['topping']; ?>" >
                            <?php echo $topping['topping']; ?>
                </input>
                 <?php endforeach;?> 
                 

 		<!-- 
<input type="checkbox" name="pizza_topping[]" value="Onion">Onions</input><br>
        <input type="checkbox" name="pizza_topping[]" value="Tomato">Tomato</input><br>
 -->


        
        Room No:
        <select name="room">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option <?php if ($room == $i) { echo 'selected = "selected"';}?> 
                    value="<?php echo $i; ?>" > <?php echo $i; ?> </option>
            <?php endfor; ?> 
        </select><br><br>
        
        
       
      
   

        <input type="submit" value="Order Pizza" /> <br><br>
    </form>
    </section>
</main>

<?php include '../view/footer.php'; 