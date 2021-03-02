

<main class="container">
    <section class="mt-2 mb-2">
        <form action="index.php" method="GET">
            <label for="categoryId">
                <h4>Category:</h4>
            </label>
            <select id="categoryId" name="categoryId">
                <option value="all">View All Categories</option>
                <?php foreach ($allCategories as $category) { ?>
                    <option value="<?php echo $category['categoryID'] ?>">
                        <?php echo $category['categoryName'] ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit" class="btn btn-primary">Submit</button>
    </section>
    </form>
    <section>
        <?php if (empty($todos)) { ?>
            <p>Sorry. No todo list items exist yet.</p>
        <?php } else { ?>
            <div class="row ms-2 me-2 mb-0">
                <div class="col d-flex justify-content-start">
                    <p class="mb-1">Title &nbsp;</p>
                    <p class="text-muted mb-1">Description</p>
                </div>
                <div class="col-3">
                    <p class="mb-1">Category</p>
                </div>
            </div>
            <ul class="list-group">
                <?php foreach ($todos as $todo) {
                  $thisCategoryId = $todo['categoryID'];
                    $thisCategoryName = get_category_name($thisCategoryId);
                ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col d-flex justify-content-start align-items-center">
                                <h6 class="me-2 mb-0"><?php echo $todo['Title'] ?></h6>
                                <p class="mb-0 text-muted"><?php echo $todo['Description'] ?></p>
                            </div>
                            <div class="col-3 d-flex justify-content-between align-items-center">

                                <p class="mb-0"><?php echo $thisCategoryName; ?></p>
                                <form action="index.php" method="POST">
                                    <input type="hidden" name="todo_itemnum" value="<?php echo $todo['ItemNum']; ?>">
                                    <input type="hidden" name="action" value="delete_item">
                                    <button class="btn-close" aria-label="Delete"></button>
                                </form>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    </section>
    <p class="mt-3"><a href="index.php?action=show_add_form">Click here</a> to add a new item.</p>
    <a href="index.php?action=show_category_form">View/Edit Categories</a>
</main>

