<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="../web/style/main.css">
</head>
<body>
    <div>
        <form class="form" method="post">
            <h1 class="form_title">Sign Up</h1>

            <div class="form_group">
                <input class="form_input" type="email" name="email" placeholder=" " required>
                <label class="form_label">Email</label>
            </div>

            <div class="form_group">
                <input class="form_input" type="text" name="login" maxlength="15" minlength="4" pattern="^[a-zA-Z0-9_.-]*$" placeholder=" " required>
                <label class="form_label">Login</label>
            </div>

            <div class="form_group">
                <input class="form_input" type="password" name="password" placeholder=" " minlength="5" required>
                <label class="form_label">Password</label>
            </div>

            <div>
                <p class="user_error"><?php echo $error ?></p>
            </div>

            <button class="form_button">Sign Up</button>

            <div class="form_sign_up">
                <p>If you already have an account, please
                    <a href="/">Sign In</a>
                </p>
            </div>
        </form>
    </div>
</body>
</html>


