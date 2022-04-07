<html>
<head>
    <title>Sign In</title>
    <link rel="stylesheet" href="../web/style/main.css">
</head>
<body>
<div>
    <form class="form" method="post">
        <h1 class="form_title">Sign In</h1>

        <div class="form_group">
            <input class="form_input" name="login" type="text" pattern="^[a-zA-Z0-9_.-]*$" placeholder=" " required>
            <label class="form_label">Login</label>
        </div>

        <div class="form_group">
            <input class="form_input" name="password" type="password" minlength="5" placeholder=" " required>
            <label class="form_label">Password</label>
        </div>
        <div>
            <p class="user_error"><?php echo $error ?></p>
        </div>

        <button class="form_button">Sign In</button>

        <div class="form_sign_up">
            <p>If you don't have an account yet, please
                <a href="/signup">Sign Up</a>
            </p>
        </div>
    </form>
</div>
</body>
</html>