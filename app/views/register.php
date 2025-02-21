<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User @Blog</title>
</head>
<body>
    <div class="page__container">
        <h1>Welcome, please register a user on our platform.</h1>
        
        <!-- error messages -->
        <?php if (isset($_GET['error'])) : ?>
            <div class="error-message">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
        <?php endif;?>

        <div class="form__wrapper">
            <form action="/register" method="POST" id="registration-form" class="form__reglog">
                <label for="username" class="input__label">Name:</label>
                <input type="text" id="username" name="username" class="input__field"
                value="<?php echo isset($_GET["username"]) ? htmlspecialchars($_GET["username"]) : '';  ?>" required>
                <br>
                <label for="email" class="input__label">E-mail:</label>
                <input type="email" id="email" name="email" class="input__field" 
                value="<?php echo isset($_GET["email"]) ? htmlspecialchars($_GET["email"])  :'' ?>" required>
                <br>
                <label for="password" class="input__label">Password:</label>
                <input type="password" id="password" name="password" class="input__field" required>
                <br>
                <button type="submit" id="register" name="register" class="btn">Register</button>
            </form>
        </div>
    </div>
</body>
</html>