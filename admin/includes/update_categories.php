<form action="" method="post">
                                <?php
                                    if(isset($_GET['edit'])){
                                        $edit_cat_id = $_GET['edit'];
                                        $query = "SELECT * FROM categories WHERE cat_id = {$edit_cat_id}";
                                        $edit_categories = mysqli_query($connection,$query);
                                        
                                        while($row = mysqli_fetch_assoc($edit_categories)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            ?>

                                                <label for="cat-title">Edit Categories</label>
                                                <div class="form-group">
                                                    <input value="<?php if(isset($cat_title)){echo $cat_title;} ?>" class="form-control" type="text" name="cat_title">
                                                </div>
                                                <div class="form-group">
                                                    <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                                                </div>
                                                
                                                <?php }
                                    } 
                                ?>

                                <?php
                                    // UPDATE Category
                                    if(isset($_POST['update_category'])){
                                        $update_cat_title = $_POST['cat_title'];
                                        $query = "UPDATE categories SET cat_title = '{$update_cat_title}' WHERE cat_id = {$edit_cat_id}";
                                        $update_query = mysqli_query($connection,$query);
                                        if(!$update_query){
                                            echo die("Update Query Failed" . mysqli_error($connection));
                                        }
                                        header("Location: categories.php");
                                    }
                                ?>

                            </form>