<?php

function initial_db($db) {
    $query = 'delete from order_topping;';
    $query.='delete from pizza_orders;';
    $query.='delete from menu_sizes;';
    $query.='delete from menu_toppings;';
    $query.='delete from pizza_sys_tab;';
    $query.='insert into pizza_sys_tab values (1);';
    $query.="insert into menu_toppings values (1,'Pepperoni');";
    $query.="insert into menu_sizes values (1,'Small');";
    $statement = $db->prepare($query);
    $statement->execute();
    return $statement;
}
