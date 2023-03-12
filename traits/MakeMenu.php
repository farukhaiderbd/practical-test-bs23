<?php
trait MakeMenu
{
    /**
     * @param array $tree
     * @param boolean $hasChildren
     * @return string
     */
     public function makeMenu(array $tree, bool $hasChildren =false): string
          {
          $item_html = '';
          foreach ($tree as $node) {
               $hasChildrenClass = !empty($node['children'])?"caret":"";
               $childrenIcon = $hasChildren ?'bx bx-folder bx-sm':'bx bx-library bx-sm';
               $item_html .= '<li><span class="'. $hasChildrenClass .'"><i class="'. $childrenIcon .'" style="font-size: medium"></i>' . $node['name'] . ' (' . $node['num_items'] . ')</span>';
               if (isset($node['children'])) {
                    $item_html .= '<ul class="nested">';
                    $item_html .= $this->makeMenu($node['children'] ,true);
                    $item_html .= '</ul>';
               }
               $item_html .= '</li>';
          }
          return $item_html;
          }
}
