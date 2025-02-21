<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login @Blog</title>
</head>
<body>
    
        <div class="page__container">
        
        <h1>Welcome, 
        
        <?php if (isset($_GET['success'])) : ?>
            <div class="success-message">
                <?php echo htmlspecialchars($_GET['success']); ?>
            </div>
        <?php endif; ?>
        
        please login.</h1>

        <div class="form__wrapper">
            <form action="/login" method="POST" id="login-form" class="form__reglog">
                <label for="email" class="input__label">E-Mail:</label>
                <input type="text" id="email" name="email" class="input__field"
                value="<?php echo isset($_GET["email"]) ? htmlspecialchars($_GET["email"]) : '';  ?>" required>
                <br>
                <label for="password" class="input__label">Password:</label>
                <input type="password" id="password" name="password" class="input__field" required>
                <br>
                <!-- error messages -->
                <?php if (isset($_GET['error'])) : ?>
                    <div class="error-message">
                    <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif;?>
                <button type="submit" id="login" name="login" class="btn">LogIn</button>
            </form>
        </div>
    </div>


</body>
</html>