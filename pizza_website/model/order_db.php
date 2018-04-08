<?php
// the try/catch for these actions is in the caller
function add_order($db, $room_number, $size, $day, $status, $topping_ids) {
	global $db;
    $query = 'INSERT INTO pizza_orders(room_number, size, day, status) '
            . 'VALUES (:room_number,:size,:day,:status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':room_number', $room_number);
    $statement->bindValue(':size', $size);
    $statement->bindValue(':day', $day);
    $statement->bindValue(':status', $status);
    $statement->execute();
    foreach ($topping_ids as $t) {
        add_order_topping($db, $t);
    }
    $statement->closeCursor();
}

function get_order($db) {
	global $db;
    $query = 'SELECT * FROM pizza_orders';
    $statement = $db->prepare($query);
    $statement->execute();
    $order = $statement->fetch();
    $statement->closeCursor();
    return $order;    
}

function add_order_topping($db, $topping_ids) {
    
//     $topping_name = get_topping_name($db, $topping_ids);
    $query = 'INSERT INTO order_topping(order_id, topping) '
            . 'VALUES (last_insert_id(),:topping)';
    $statement = $db->prepare($query);
    $statement->bindValue(':topping', $topping_ids);
    $statement->execute();
    $statement->closeCursor();
    
}


function get_preparing_orders($db) {
    $query = 'SELECT * FROM pizza_orders where status=\'Preparing\'';
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;  
}

function get_baked_orders($db) {
    $query = 'SELECT * FROM pizza_orders where status=(\'Baked\')';
    $statement = $db->prepare($query);
    $statement->execute(); 
    $orders = $statement->fetchAll();
    $statement->closeCursor();    
    return $orders;  
}

function get_preparing_orders_of_room($db, $room) {
    $query = 'SELECT * FROM pizza_orders where room_number=:room';
    $statement = $db->prepare($query);
    $statement->bindValue(':room',$room);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor(); 
//     $orders = add_toppings_to_orders($db, $orders);
    return $orders;    
}

function get_baked_orders_of_room($db, $room) {
    $query = 'SELECT * FROM pizza_orders where status=\'Baked\' and room_number=:room';
    $statement = $db->prepare($query);
    $statement->bindValue(':room',$room);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor(); 
    $orders1 = add_toppings_to_orders($db, $orders);     
    return $orders1;    
}

function add_toppings_to_orders($db, $orders) {
      for ($i=0; $i<count($orders);$i++) {
        $toppings = get_orders_toppings($db, $orders[$i]['id']);
        $orders[$i]['toppings'] = $toppings;
    } 
    return $orders;
}

function get_orders_toppings($db, $order_id) {
    $query = 'select topping from order_topping '
            . 'where order_id=:order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id',$order_id);
    $statement->execute();
    $toppings = $statement->fetchAll();
    $statement->closeCursor();
    return $toppings;
}
function change_to_baked($db, $id) {
    $query = 'UPDATE pizza_orders SET status= \'Baked\' WHERE status=\'Preparing\' and id=:id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id',$id);
    $statement->execute();
    $statement->closeCursor();     
}

function get_oldest_preparing_id($db) {
    $query = 'SELECT min(id) AS id FROM pizza_orders where status=\'Preparing\'';
    $statement = $db->prepare($query);
    $statement->execute();
    $id = $statement->fetch();
    $statement->closeCursor();
    return $id['id'];
}

function update_to_finished($db, $room) {
    $query = 'UPDATE pizza_orders SET status=\'Finished\' WHERE status = \'Baked\' and room_number = :room';
    $statement = $db->prepare($query);
    $statement->bindValue(':room',$room);
    $statement->execute();
    $statement->closeCursor();        
}

function get_all_orders($db, $room) {
	global $db;
    $query = 'select pizza_orders.id, pizza_orders.room_number, pizza_orders.status, order_topping.topping from pizza_orders JOIN order_topping ON pizza_orders.id = order_topping.order_id Where room_number = "'.$room.'";';
	$statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    return $orders;    
}
