<?php
// the try/catch for these actions is in the caller
function add_size($db, $size_name) {
	global $db;
    $query = 'INSERT INTO menu_sizes
                 (size)
              VALUES
                 (:size)';
    $statement = $db->prepare($query);
    $statement->bindValue(':size', $size_name);
    $statement->execute();
    $statement->closeCursor();

}

function get_sizes($db) {
    $query = 'SELECT * FROM menu_sizes';
    $statement = $db->prepare($query);
    $statement->execute();
    $size = $statement->fetchAll();
    $statement->closeCursor();
    return $size;    
}

function delete_size($db, $size_id)  
{
    $query = 'DELETE FROM menu_sizes
                 WHERE id = :size_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':size_id', $size_id);
    $statement->execute();
    $statement->closeCursor();
}