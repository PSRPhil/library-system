<?php if(!isLoggedIn()){ ?>
<?php
    // Process the login form
    if(isset($_POST["login"])){
        if(User::login($_POST)){
            redirect("index.php");
        }else{
            $message = "Your username or password was incorrect";
            $class = "red bold";	
        }
    }else{
        $message = "";
        $class = "";	
    }
?>
<form id="login-form" name="login" action="" method="post">
    <?php echo outputMessage($message, $class); ?>
    <div id="block">
        <label id="user" for="name">Username</label>
        <input type="text" name="username" autocomplete="off" id="name" placeholder="Username" required/>
        <label id="pass" for="password">Password</label>
        <input type="password" name="pass" id="password" placeholder="Password" required />
        <input type="submit" id="submit" name="login" value="Sign in"/>
    </div>
</form>
<?php } ?>

