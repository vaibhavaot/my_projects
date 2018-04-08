<?php include '../view/header.php'; 
?>
<main>
    <section>
        <h1> Free Pizza for Students <h1>
        <h2>Available Sizes</h1>
        <ul>
                 <?php foreach ($sizes as $size) : ?>
            <tr>
                <td><?php echo $size['size']; ?></td>
                
              
            </tr>
            <?php endforeach; ?>
        </ul>
        <h2>Available Toppings</h1>
        <ul>
             <?php foreach ($toppings as $topping) : ?>
                <tr>
                    <td><?php echo $topping['topping']; ?></td>
                    
                	
                </tr>
            <?php endforeach; ?>
        </ul>

        <form  action="index.php" method="post">
            <input type="hidden" name="action" value="select_room">
            <label>Room No:</label>
            <select name="room" required="required">
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <option   <?php
                    if ($room == $i) {
                        echo 'selected = "selected"';
                    }
                    ?> 
                        value="<?php echo $i; ?>" > <?php echo $i; ?>
                    </option>
                <?php endfor; ?> 
            </select>
            <input style="float:none;" type="submit" value="Select Room" /> <br><br>
        </form>
        <h2>Order in process for Room..</h2>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>Room No</th>
                    <th>Toppings</th>
                    <th>Status</th>

                </tr>
		<?php foreach ($orders as $room_order) : ?>
                    <tr>
                        <td><?php echo $room_order['id']; ?> </td>
                        <td><?php echo $room_order['room_number']; ?> </td>

                        <td><?php
                            $toppings = $room_order['topping'];
                            echo $toppings;
                            // foreach ($toppings as $t)
//                                 echo $t['topping'] . ' ';
                            ?>
                            </td>    
                        <td><?php echo $room_order['status']; ?> </td>


                    </tr>
                <?php endforeach; ?>
                </table>
        
	<form action="index.php" method="post" >
            <input type="hidden" name="action" value="update_order_status">
            <input type="submit" value="Acknowledge Delivery of Baked Pizza" />
            <br>
        </form>
        
        
        <br><br>
        	

        <p>
            <a href="index.php?action=order_pizza"><strong>Order Pizza</strong></a>
        </p>
    </section>
</main>
<?php include '../view/footer.php'; 
