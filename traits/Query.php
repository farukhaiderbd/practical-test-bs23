<?php
trait Query
{
    public function query($query)
    {
        $stmt = $this->conn->prepare($query); # prepare PDO statement
        $stmt->execute(); # execute PDO query
        return $stmt;
    }

     /**
      * @param $categories
      * @param int $parentId
      * @return int|mixed
      */
     protected function  getChildrenNumItems($categories, int $parentId = 0): mixed
          {
          $total_items_count = 0;
          foreach ($categories as $category) {
               if ($category['ParentcategoryId'] == $parentId) {
                    $query = 'SELECT category.name, 
                COUNT(DISTINCT item_category_relations.ItemNumber) AS num_items
                FROM item_category_relations 
                LEFT JOIN category ON category.id = item_category_relations.categoryId 
                WHERE category.id = ' . $category['id'] . ' GROUP BY category.name ORDER BY num_items DESC';

                    $stmt = $this->conn->prepare($query);
                    $stmt->execute();
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    $total_items_count += $result['num_items'] ?? 0;
                    $total_items_count += $this->getChildrenNumItems($categories, $category['id']);
               }
          }
          return $total_items_count;
          }
}
