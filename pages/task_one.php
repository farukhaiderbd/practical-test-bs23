<?php
require '../classes/TaskOne.php';

try {
    $database = new DB(); # Database instantiate & connect
    $db = $database->connect();

    $task_one = new TaskOne($db); # instantiate TaskOne object


    $result = $task_one->read(); # query of category join category_relations PDO statement
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
    $tree = $task_one->buildTree($task_one_arr); # make table name, num_items
   $task_one_tree = $task_one->makeTable($tree); # make table

} catch (Exception $e) {
     $task_one_tree = $e->getMessage();
}
$page_title ="Task One"
?>
<?php include_once '../views/layout/header.php';?>
    <div class="main">
        <a href="../index.php"><i class="bx bx-home"></i></a>
        <h1>Task 1</h1>
        <hr>
        <?php echo  $task_one_tree; ?>
    </div>
<?php include_once '../views/layout/footer.php';?>
