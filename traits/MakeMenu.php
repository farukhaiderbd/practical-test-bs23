<?php
trait MakeMenu
{
    /**
     * @param array $tree
     * @return string
     */
     public function makeMenu(array $tree): string
          {
          $item_html = '';
          foreach ($tree as $node) {
               $item_html .= '<li><a href="#">' . $node['name'] . ' (' . $node['num_items'] . ')</a>';
               if (isset($node['children'])) {
                    $item_html .= '<ul>';
                    $item_html .= $this->makeMenu($node['children']);
                    $item_html .= '</ul>';
               }
               $item_html .= '</li>';
          }
          return $item_html;
          }
}
