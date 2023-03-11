<?php
trait BuildTree
{
    /**
     * @param $categories
     * @param mixed $parentId
     * @param bool $hasChildren
     * @return array
     */
    public function buildTree($categories, mixed $parentId = 0, bool $hasChildren = false): array
    {
        $tree_arr = array(); # Make an empty array and initialize it to store the tree structure.

        foreach ($categories as $category) {
            if ($category['ParentcategoryId'] == $parentId) { # Add the category to the tree if its parent ID matches the current parent ID.
                $node = array(
                    'name' => $category['name'],
                    'id' => $category['id'],
                ); # Initialize an array to store the category data.

                 /*
                    category id to find item_category_relations table left join with category table and another left join with
                    item table with itemsNumber with number get total items
                */
                $query = 'SELECT category.name, COUNT(DISTINCT item_category_relations.ItemNumber) AS num_items FROM item_category_relations LEFT JOIN category ON category.id = item_category_relations.categoryId WHERE category.id = ' . $category['id'] . ' GROUP BY category.name ORDER BY num_items DESC';

                $stmt = $this->conn->prepare($query);   # prepare PDO statement
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $node['num_items'] = $result['num_items'] ?? 0;
                $node['num_items'] += $this->getChildrenNumItems($categories, $category['id']);

                if ($hasChildren) { # Add to the tree if there are no children.
                    $children = $this->buildTree($categories, $category['id'], true); # Build the tree Recursively for the current category.
                    if ($children) {
                        $node['children'] = $children;
                    }
                }
                $tree_arr[] = $node;
            }
        }
        // Tree structure return
        return $tree_arr;
    }
}
