<?php
require_once('db_connect.php');

function get_categories()
{
    global $db;
    $queryAllCategories = 'SELECT * FROM categories ORDER BY categoryID';
    $getCategoriesStatement = $db->prepare($queryAllCategories);
    $getCategoriesStatement->execute();
    $allCategories = $getCategoriesStatement->fetchAll();
    $getCategoriesStatement->closeCursor();
    return $allCategories;
}

function get_category_name($categoryId)
{
    global $db;
    $queryCategoryName = 'SELECT categoryName FROM categories WHERE categoryID = :categoryId';
    $getCategoryNameStatement = $db->prepare($queryCategoryName);
    $getCategoryNameStatement->bindValue(':categoryId', $categoryId);
    $getCategoryNameStatement->execute();
    $thisCategoryNameArray = $getCategoryNameStatement->fetch();
    if ($thisCategoryNameArray === FALSE || $thisCategoryNameArray === NULL) {
        $thisCategoryName = 'None';
    } else {
        $thisCategoryName = $thisCategoryNameArray['categoryName'];
    }
    return $thisCategoryName;
}

function add_category($new_category_name)
{
    global $db;
    $insertCategoryQuery = 'INSERT INTO categories (categoryName)
                    VALUES (:new_category_name)';
    $insertCategoryStatement = $db->prepare($insertCategoryQuery);
    $insertCategoryStatement->bindValue(':new_category_name', $new_category_name);
    $insertCategoryStatement->execute();
    $insertCategoryStatement->closeCursor();
}

function delete_category($category_id_to_delete)
{
    global $db;
    $deleteCategoryQuery = 'DELETE FROM categories
    WHERE categoryId = :category_id_to_delete';
    $deleteCategoryStatement = $db->prepare($deleteCategoryQuery);
    $deleteCategoryStatement->bindValue(':category_id_to_delete', $category_id_to_delete);
    $deleteCategoryStatement->execute();
    $deleteCategoryStatement->closeCursor();
}