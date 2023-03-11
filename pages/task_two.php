<?php
require '../classes/TaskTwo.php';

try {
     // Database instantiate & connect
     $database = new DB();
     $db = $database->connect();

     // instantiate TaskTwo object
     $task_two = new TaskTwo($db);

     // query of category join category_relations PDO statement
     $result = $task_two->read();

     // make empty array
     $task_two_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $task_two_item = array(
            'id' => $id,
            'name' => $name,
            'ParentcategoryId' => !empty($ParentcategoryId) ? $ParentcategoryId : 0
        );
        // push to 'data'
        $task_two_arr[] = $task_two_item;
    }
    $tree = $task_two->buildTree($task_two_arr, null, true);


    // make a menu
    echo '<ul>';
    echo $task_two->makeMenu($tree);
    echo '</ul>';
} catch (Exception $e) {
    echo $e->getMessage();
}
