<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th colspan="2">Change to</th>
            <th colspan="2">Commands</th>
            


        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection,$query);
            
            while($row = mysqli_fetch_assoc($select_users)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
                // $comment_date = $row['comment_date'];


                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";
                
                // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                // $select_post_id_query = mysqli_query($connection,$query);
                // while($row = mysqli_fetch_assoc($select_post_id_query)){
                //     $post_id = $row['post_id'];
                //     $post_title = $row['post_title'];

                //     echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
                // }



                // echo "<td>$comment_date</td>";

                echo "<td><a href='users.php?change_to_admin={$user_id}' ";
                if($user_role == 'admin'){
                    echo "style='pointer-events: none;'";
                } 
                echo ">Admin</a></td>";

                echo "<td><a href='users.php?change_to_subscriber={$user_id}' ";
                if($user_role == 'subscriber'){
                    echo "style='pointer-events: none;'";
                } 
                echo ">Subscriber</a></td>";


                // echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";

                echo "<td><a href='users.php?delete={$user_id}'><i class='fa fa-trash-o'></i> DELETE</a></td>";
                echo "<td><a href='users.php?source=edit_user&the_user_id={$user_id}'><i class='fa fa-edit'></i> EDIT</a></td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php

    if(isset($_GET['change_to_admin'])){
        $the_user_id = $_GET['change_to_admin'];

        $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id";
        $change_to_admin_user_query = mysqli_query($connection, $query);
        confirm($change_to_admin_user_query);

        header("Location: users.php");

    }

    if(isset($_GET['change_to_subscriber'])){
        $the_user_id = $_GET['change_to_subscriber'];

        $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
        $change_to_subscriber_user_query = mysqli_query($connection, $query);
        confirm($change_to_subscriber_user_query);

        header("Location: users.php");

    }

    if(isset($_GET['delete'])){
        $the_user_id = $_GET['delete'];

        $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
        $delete_user = mysqli_query($connection, $query);

        header("Location: users.php");

    }
?>

