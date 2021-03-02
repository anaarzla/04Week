
    <main class="container">
        <section>
            <h4 class="mt-1 mb-1">Category List</h4>
            <ul class="list-group">
                <?php foreach ($allCategories as $category) { ?>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col d-flex justify-content-start align-items-center">
                                <h6 class="me-2 mb-0"><?php echo $category['categoryName'] ?></h6>
                            </div>
                            <div class="col-3 d-flex flex-row-reverse align-items-center">
                                <form action="index.php" method="POST">
                                    <input type="hidden" name="action" value="delete_category">
                                    <input type="hidden" name="category_id_to_delete" value="<?php echo $category['categoryID']; ?>">
                                    <button class="btn-close" aria-label="Delete"></button>
                                </form>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </section>
        <section>
            <h4 class="mt-1 mb-1">Add Category</h4>
            <form class="row" action="index.php" method="POST">
                <div class="col-auto d-flex align-items-center">
                    <label for="new_category_name">
                        Name:
                    </label>
                </div>
                <div class="col-auto">
                    <input class="form-control m-1" type="text" name="new_category_name" placeholder="Category Name">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary m-1">Add Category</button>
                </div>
                <input type="hidden" name="action" value="add_category">
            </form>
        </section>
        <a href="index.php?action=list_items">View/Edit Todo List</a>
