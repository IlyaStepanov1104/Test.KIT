<?php

function create_tree(&$data, $parent_id = null)
{
    $tree = array();
    foreach ($data as &$leaf) {
        if ($leaf['parent'] == $parent_id) {
            $children = create_tree($data, $leaf['id']);
            if ($children) {
                $leaf['children'] = $children;
            }
            $tree[] = array(
                'name' => $leaf['name'],
                'description' => $leaf['description'],
                'children' => $leaf['children']
            );
        }
    }
    return $tree;
}


function print_tree($tree){
    if (is_array($tree)) {
        foreach ($tree as $leaf) {
            echo "<div class='flex'><p onclick=\"
                alert('Описание \'".$leaf['name']."\':  ".$leaf['description']."');
            \">" . $leaf['name'] . "</p>
            <button class='collapsible'>+</button></div>";
            if (!isset($tree['children'])) {
                echo "<div class='content'>";
                print_tree($leaf['children']);
                echo '</div>';
            }
        }
    }
}

function print_tree_admin($tree, $nesting_number = 0){
    if (is_array($tree)) {
        foreach ($tree as $leaf) {
            echo "<p>" .str_repeat("&mdash;", $nesting_number) . $leaf['name'] . "</p>";
            if (!isset($tree['children'])) {
                print_tree_admin($leaf['children'], $nesting_number + 1);
            }
        }
    }
}


function get_tree($pdo){
    $sth = $pdo->prepare("SELECT * FROM data");
    $sth->execute();
    $data = $sth->fetchAll(PDO::FETCH_ASSOC);
    return create_tree($data);
}
