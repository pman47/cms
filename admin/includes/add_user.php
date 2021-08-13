<?php
    if(isset($_POST['create_user'])){
        
        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];



        // $post_image = $_FILES['image']['name'];
        // $post_image_temp = $_FILES['image']['tmp_name'];

        // $post_comment_count = 4;

        // move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO users(user_firstname, user_lastname, user_role, username, user_email, user_password ) ";
        $query .= "VALUES ('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}')";

        $create_user_query = mysqli_query($connection,$query);

        confirm($create_user_query);

        echo "<div class='alert alert-success' role='alert'>User Created : <a href='users.php' class='alert-link'>Check Out</a>.</div>";

    }
?>



<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Firstname</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_status">Lastname</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    
    <div class="form-group">
        <label for="post_status">Role</label><br/>
        <select name="user_role" id="">
            <option value="subscriber">Select Role</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Username</label>
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="post_tags">Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>

    <div class="form-group">
        <label for="post_tags">Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>

    <div class="form-group">
        <input type="submit" value="Add User" name="create_user" class="btn btn-primary">
    </div>

</form>