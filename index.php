<?php
require('./model/db_connect.php');
require('./model/item_db.php');
require('./model/category_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_items';
    }
}

if ($action == 'list_items') {
    if (!isset($categoryId)) {
        $categoryId = filter_input(
            INPUT_GET,
            'categoryId',
            FILTER_VALIDATE_INT
        );
    }
    $allCategories = get_categories();
    $todos = get_todos_by_category($categoryId);
    include('./view/item_list.php');
} else if ($action == 'add_item') {
    $new_todo_title = filter_input(INPUT_POST, 'new_todo_title');
    $new_todo_description = filter_input(INPUT_POST, 'new_todo_description');
    $new_todo_categoryId = filter_input(INPUT_POST, 'new_todo_categoryId', FILTER_VALIDATE_INT);
    add_todo($new_todo_title, $new_todo_description, $new_todo_categoryId);
    header('Location: .?action=list_items');
} else if ($action == 'delete_item') {
    $delete_todo_itemnum = filter_input(INPUT_POST, 'todo_itemnum');
    delete_todo($delete_todo_itemnum);
    header('Location: .?action=list_items');
} else if ($action == 'show_add_form') {
    $allCategories = get_categories();
    include('./view/add_item_form.php');
} else if ($action == 'show_category_form') {
    $allCategories = get_categories();
    include('./view/category_list.php');
} else if ($action == 'add_category') {
    $new_category_name = filter_input(INPUT_POST, 'new_category_name');
    add_category($new_category_name);
    header('Location: .?action=show_category_form');
} else if ($action == 'delete_category') {
    $category_id_to_delete = filter_input(INPUT_POST, 'category_id_to_delete', FILTER_VALIDATE_INT);
    delete_category($category_id_to_delete);
    header('Location: .?action=show_category_form');
}
