<?php

require('../model/database.php');
require('../model/topping_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) 
{
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) 
    {
        $action = 'list_toppings';
    }
}

if ($action == 'list_toppings') 
{
    try
    {
        $toppings = get_toppings($db);
        include('topping_list.php');
    } 
    catch (PDOException $e) 
    {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
    }
} 

else if ($action == 'add_topping') 
{
    $topping_name = filter_input(INPUT_POST, 'topping_name');
    if ($topping_name == NULL || $topping_name == FALSE) 
    {
        $error = "Invalid topping name";
        include('../errors/error.php');
    } 
    else 
    {
        try 
        {
            add_topping($db, $topping_name);
        } 
        catch (PDOException $e) 
        {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();  // needed here to avoid redirection of next line
        }
        // Redirect back to index.php (see pp. 164-165)
        // (don't include index.php inside index.php)
        header("Location: .");
    }
}
else if ($action == 'delete_topping') 
{
    $topping_id = filter_input(INPUT_POST, 'topping_id', 
            FILTER_VALIDATE_INT);
     if ($topping_id == NULL || $topping_id == FALSE) 
         {
        $error = "Missing or incorrect topping.";
        include('../errors/error.php');
        } 
        else 
        {
        try 
            {
            delete_topping($db, $topping_id);
            } 
        catch (PDOException $e) 
            {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
            }
        header("Location: .");
		}
}		

