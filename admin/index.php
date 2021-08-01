<?php include('./includes/admin_header.php'); ?>

    <!-- <?php if($connection) echo "conn"; ?> -->
        <!-- Navigation -->
        <?php include('./includes/admin_navigation.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username'];?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">

                                        <!-- POSTS -->
                                        <?php

                                            $query = "SELECT * FROM posts";
                                            $select_all_post =  mysqli_query($connection,$query);
                                            $post_counts = mysqli_num_rows($select_all_post);

                                        ?>
                                        <div class='huge'><?php echo $post_counts;?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- COMMENTS -->
                                        <?php

                                            $query = "SELECT * FROM comments";
                                            $select_all_comment =  mysqli_query($connection,$query);
                                            $comment_counts = mysqli_num_rows($select_all_comment);

                                        ?>
                                        <div class='huge'><?php echo $comment_counts; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- USERS -->
                                        <?php

                                            $query = "SELECT * FROM users";
                                            $select_all_user =  mysqli_query($connection,$query);
                                            $user_counts = mysqli_num_rows($select_all_user);

                                        ?>
                                        <div class='huge'><?php echo $user_counts;?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <!-- CATEGORIES -->
                                        <?php

                                            $query = "SELECT * FROM categories";
                                            $select_all_category =  mysqli_query($connection,$query);
                                            $category_counts = mysqli_num_rows($select_all_category);

                                        ?>
                                        <div class='huge'><?php echo $category_counts;?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="category.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->


                <?php
                
                    $query = "SELECT * FROM posts WHERE post_status = 'draft'";
                    $select_all_draft_post =  mysqli_query($connection,$query);
                    $post_draft_counts = mysqli_num_rows($select_all_draft_post);
                
                    $query = "SELECT * FROM comments WHERE comment_status = 'unapproved'";
                    $select_all_unapproved_comments =  mysqli_query($connection,$query);
                    $unapproved_comments_counts = mysqli_num_rows($select_all_unapproved_comments);
                
                    $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
                    $select_all_subscriber =  mysqli_query($connection,$query);
                    $subscriber_counts = mysqli_num_rows($select_all_subscriber);
                
                ?>



                <div class="row">
                    <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php

                            $element_text = ['Posts','Draft Posts','Comments','Unapproved Comments','Users','Subscribers','Categories'];
                            $element_count = [$post_counts,$post_draft_counts,$comment_counts,$unapproved_comments_counts,$user_counts,$subscriber_counts,$category_counts];

                            for($i=0;$i<7;$i++){
                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }

                        ?>
                        
                        // ['Posts', 1000],
                        ]);

                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                    </script>

                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>

                </div>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include('./includes/admin_footer.php'); ?>