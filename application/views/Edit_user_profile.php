<html>
<body>
<h1>Edit user account </h1>
<br>
<br>
<br>
<?php echo $result  ?>

<form method="POST" action="">
    new_user_name : <input type="text" name="user_name" />
    <br>
    new_password : <input type="password" name="password" />
    <br>
    new_email : <input type="text" name="email" />
    <br>
    new_mobile number : <input type="number" name="mobile_number" />
    <br>
    new_profile picture : <input type="text" name="profile_picture">
    <br>
    <br>

    <input type="submit" name="submit" value="submit">
</form>

</body>
</html>
