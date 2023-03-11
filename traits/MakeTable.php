<?php
trait MakeTable
{
    /**
     * @param array $tree
     * @return void
     */
    public function makeTable(array $tree = []): void
    {
         $table_html = '<table border="1" style="border-collapse: collapse; width: 100%;">';
         $table_html .=  '<tr>';
         $table_html .=  '<th>Category Name</th>';
         $table_html .=  '<th>Total Items</th>';
         $table_html .=  '</tr>';
        foreach ($tree as $item) {
             $table_html .= '<tr>';
             $table_html .= '<td>' . $item['name'] . '</td>';
             $table_html .= '<td>' . $item['num_items'] . '</td>';
             $table_html .= '</tr>';
        }
        $table_html .= '</table>';
        echo $table_html;
    }
}
