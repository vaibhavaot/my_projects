<?php
require('../model/database.php');
require('../model/topping_db.php');
require('../model/size_db.php');
require('../model/order_db.php');
require('../model/day_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'student_welcome';
    }
}
$room = filter_input(INPUT_POST,'room',FILTER_VALIDATE_INT);
if ($room == NULL) {
    $room = filter_input(INPUT_GET, 'room');
    if ($room == NULL || $room == FALSE) {
       $room = 1;
    }
}

if ($action == 'student_welcome' || $action == 'select_room') 
{
    try 
    { 
        $sizes = get_sizes($db);
        $toppings = get_toppings($db);
        $room_preparing_orders = get_preparing_orders_of_room($db, $room);
        $room_baked_orders = get_baked_orders_of_room($db, $room);
        $orders = get_all_orders($db, $room);
       // print_r($room_preparing_orders);
        include('student_welcome.php');
    } 
    catch (PDOException $e) 
    {
      $error_message = $e->getMessage(); 
      include('../errors/database_error.php');
      
    }
}    
else if ($action == 'order_pizza') 
{
try{
        $sizes = get_sizes($db);
        $toppings = get_toppings($db);
            include('order_pizza.php');
	}
    catch (PDOException $e) 
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');    
    }
    
}
elseif ($action == 'add_order') 
{
	$sizes = get_sizes($db);
   	$size_id = filter_input(INPUT_GET, 'pizza_size');
        $room = filter_input(INPUT_GET, 'room', FILTER_VALIDATE_INT);
 	$status = 'Preparing';
        $topping_ids = filter_input(INPUT_GET, 'pizza_topping', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
//     print_r($topping_ids);

    try {
        $current_day = get_day($db);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
   
// 	$topping_ids = [1,24];

    if ($size_id == NULL || $size_id == FALSE || $topping_ids == NULL) 
    {
        $error = "Invalid size or topping data." . "$size_id" . " $room";
        include('../errors/error.php');
    }
    try {
        add_order($db, $room, $size_id, $current_day, $status, $topping_ids);
       // include('student_welcome.php');
        
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
        
    }
    header("Location: .");
  
} elseif ($action == 'update_order_status') {
    try {
        update_to_finished($db, $room);
        
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
    header("Location: .");
}
