<?php
require_once('db_connect.php');

function get_todos_by_category($categoryId)
{
    global $db;
    if ($categoryId == NULL || $categoryId == FALSE) {
        $queryAllTodos = 'SELECT * FROM categories ORDER BY itemnum';
        $getTodosStatement = $db->prepare($queryAllTodos);
        $getTodosStatement->execute();
        $todos = $getTodosStatement->fetchAll();
        $getTodosStatement->closeCursor();
        return $todos;
    } else {
        $querySelectTodos = 'SELECT * FROM categories WHERE categoryID = :categoryId ORDER BY itemnum';
        $getTodosStatement = $db->prepare($querySelectTodos);
        $getTodosStatement->bindValue(':categoryId', $categoryId);
        $getTodosStatement->execute();
        $todos = $getTodosStatement->fetchAll();
        $getTodosStatement->closeCursor();
        return $todos;
    }
}

function get_todo($itemNum) {
    global $db;
    $queryTodo = 'SELECT * FROM categories WHERE itemnum = :itemNum';
    $getTodoStatement = $db->prepare($queryTodo);
    $getTodoStatement->bindValue(':itemNum', $itemNum);
    $getTodoStatement->execute();
    $todo = $getTodoStatement->fetch();
    $getTodoStatement->closeCursor();
    return $todo;
}

function delete_todo($itemnum)
{
    global $db;
    $deleteTodoQuery = 'DELETE FROM categories
                WHERE itemnum = :itemnum';
    $deleteTodoStatement = $db->prepare($deleteTodoQuery);
    $deleteTodoStatement->bindValue(':itemnum', $itemnum);
    $deleteTodoStatement->execute();
    $deleteTodoStatement->closeCursor();
}

function add_todo($title, $description, $categoryId)
{
    global $db;
    $insertTodoQuery = 'INSERT INTO categories (title, description, categoryid)
                VALUES (:title, :description, :categoryId)';
    $insertTodoStatement = $db->prepare($insertTodoQuery);
    $insertTodoStatement->bindValue(':title', $title);
    $insertTodoStatement->bindValue(':description', $description);
    $insertTodoStatement->bindValue(':categoryId', $categoryId);
    $insertTodoStatement->execute();
    $insertTodoStatement->closeCursor();
}