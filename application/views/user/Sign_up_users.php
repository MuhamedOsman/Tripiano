<?php


?>

<html>
<body>
<h1>Sign Up page </h1>
<br>
<br>
<br>
<?php
//echo $result
?>

<form method="POST" action="sign_up_users_S">
    user_name : <input type="text" name="user_name" />
    <br>
    password : <input type="password" name="password" />
    <br>
    email : <input type="text" name="email" />
    <br>
    mobile number : <input type="number" name="mobile_number" />
    <br>
    profile picture : <input type="text" name="profile_picture">
    <br>
    <br>
    <input type="submit" name="submit" value="submit">
</form>

</body>
</html>
