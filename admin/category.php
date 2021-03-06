<?php include('./includes/admin_header.php'); ?>

        <!-- Navigation -->
        <?php include('./includes/admin_navigation.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Categories</small>
                        </h1>

                        <div class="col-xs-6">

                            <?php
                                if(isset($_POST['submit'])){
                                    $cat_title = $_POST['cat_title'];

                                    if($cat_title == "" || empty($cat_title)){
                                        echo "This field should not be empty.";
                                    }else{
                                        $query = "INSERT INTO categories(cat_title) VALUES ('{$cat_title}') ";
                                        $create_category = mysqli_query($connection,$query);

                                        if(!$create_category){
                                            die("QUERY FAILED ") . mysqli_error($connection);
                                        }
                                    }
                                }
                            ?>

                            <form action="" method="post">
                                <label for="cat-title">Add Categories</label>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="cat_title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <?php
                            if(isset($_GET['edit'])){
                                $edit_cat_id = $_GET['edit'];
                                include('./includes/update_categories.php');
                            }
                            ?>


                        </div>

                        <div class="col-xs-6">
                            
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                        <th colspan="2">COMMANDS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        // Find All Categories Query
                                        $query = "SELECT * FROM categories";
                                        $select_categories = mysqli_query($connection,$query);

                                        while($row = mysqli_fetch_assoc($select_categories)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            echo "<tr>";
                                            echo "<td>{$cat_id}</td>";
                                            echo "<td>{$cat_title}</td>";
                                            echo "<td><a href='category.php?delete={$cat_id}'>DELETE</a></td>";
                                            echo "<td><a href='category.php?edit={$cat_id}'>EDIT</a></td>";
                                            echo "</tr>";
                                        }
                                    ?>

                                    <?php
                                        // Delete Category
                                        if(isset($_GET['delete'])){
                                            $the_cat_id = $_GET['delete'];

                                            $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
                                            $delete_query = mysqli_query($connection,$query);
                                            header("Location: category.php");
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include('./includes/admin_footer.php'); ?>