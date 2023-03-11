<?php
require '../classes/TaskOne.php';

try {
    // Database instantiate & connect
    $database = new DB();
    $db = $database->connect();

    // instantiate TaskOne object
    $task_one = new TaskOne($db);

    // query of category join category_relations PDO statement
    $result = $task_one->read();

    // make empty array
    $task_one_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $task_one_item = array(
            'id' => $id,
            'name' => $name,
            'ParentcategoryId' => !empty($ParentcategoryId) ? $ParentcategoryId : 0
        );
        // push to 'data'
        $task_one_arr[] = $task_one_item;
    }
    // make table name, num_items
    $tree = $task_one->buildTree($task_one_arr);
    // make table
    $task_one->makeTable($tree);

} catch (Exception $e) {
    echo $e->getMessage();
}
