<?php
// the try/catch for these actions is in the caller
function add_topping($db, $topping_name) {
	global $db;
    $query = 'INSERT INTO menu_toppings
                 (topping)
              VALUES
                 (:topping)';
    $statement = $db->prepare($query);
    $statement->bindValue(':topping', $topping_name);
    $statement->execute();
    $statement->closeCursor();
}

function get_toppings($db) {
    $query = 'SELECT * FROM menu_toppings';
    $statement = $db->prepare($query);
    $statement->execute();
    $toppings = $statement->fetchAll();
    return $toppings;    
}

function get_topping_name($db, $topping_id) {
    $query = 'SELECT topping FROM menu_toppings where id = :id';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $topping_id);
    $statement->execute();
    $topping_row = $statement->fetch();
    return $topping_row['topping'];    
}

function delete_topping($db, $topping_id)  
{
    $query = 'DELETE FROM menu_toppings
                 WHERE id = :topping_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':topping_id', $topping_id);
    $statement->execute();
    $statement->closeCursor();
}