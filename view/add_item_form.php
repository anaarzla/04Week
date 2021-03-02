

<main class="container">
    <section>
        <h4 class="mt-2">Add Item</h4>
        <form action="index.php" method="POST">
            <label for="new_todo_categoryId">
                Category:
            </label>
            <input type="hidden" name="action" value="add_item">
            <select id="new_todo_categoryId" name="new_todo_categoryId">
                <?php foreach ($allCategories as $category) { ?>
                    <option value="<?php echo $category['categoryID'] ?>">
                        <?php echo $category['categoryName'] ?>
                    </option>
                <?php } ?>
            </select>
            <input class="form-control m-1" type="text" name="new_todo_title" placeholder="Title">
            <input class="form-control m-1" type="text" name="new_todo_description" placeholder="Description">
            <button class="btn btn-primary m-1">Add Item</button>
        </form>
        <a href="index.php?action=list_items">View/Edit Todo List</a>
    </section>
</main>
