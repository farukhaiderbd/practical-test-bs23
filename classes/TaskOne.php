<?php
require '../traits/MakeTable.php';
require '../traits/DBConnection.php';
require '../traits/Query.php';
require '../traits/BuildTree.php';
require '../traits/MakeMenu.php';

class TaskOne  {
    use MakeTable, DBConnection, Query, BuildTree,MakeMenu;

     /**
      * @return object
      */
    public function read(): Object
    {
        return $this->query('SELECT category.id, category.name, 
                    catetory_relations.ParentcategoryId FROM category 
                    LEFT JOIN catetory_relations  ON 
                    category.id = catetory_relations.categoryId');
    }


}

