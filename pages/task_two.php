<?php
require '../classes/TaskTwo.php';

try {
     $database = new DB(); #Database instantiate & connect
     $db = $database->connect();

     $task_two = new TaskTwo($db); #instantiate TaskTwo object

     $result = $task_two->read(); #query of category join category_relations PDO statement
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

     $task_two_tree = $task_two->makeMenu($tree); #make a menu
} catch (Exception $e) {
    echo $e->getMessage();
}
$page_title ="Task Two"
?>
<?php include_once '../views/layout/header.php';?>
     <div class="main">
         <a href="../index.php"><i class="bx bx-home"></i></a>
          <h1>Task Two</h1>
          <hr>
         <ul id="myUL">
               <?php echo  $task_two_tree; ?>
          </ul>

     </div>

    <script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    </script>
<?php include_once '../views/layout/footer.php';?>