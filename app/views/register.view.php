<?php
$title = "@Blog - Register";
ob_start();
?>  
<div class="page__container flex flex-col justify-center items-center">
    <h1 class="header__wrapper mx-auto py-8">Welcome, please register on our platform.</h1>
    
    <!-- error messages -->
    <?php if (isset($_GET['error'])) : ?>
        <div class="error-message text-red-900 py-2">
        <?php echo htmlspecialchars($_GET['error']); ?>
    </div>
    <?php endif;?>

    <div class="form__wrapper my-4">
        <form action="/register" method="POST" id="registration-form" class="form__reglog flex flex-col">
            <label for="username" class="input__label">Name:</label>
            <input type="text" id="username" name="username" class="input__field border-1 border-blue-500 rounded-md px-2 py-1"
            value="<?php echo isset($_GET["username"]) ? htmlspecialchars($_GET["username"]) : '';  ?>" minlength="1" maxlength="50" required>
                <?php if (isset($errors['username'])): ?> 
                    <p class="text-red-500 font-bold text-sm mt-2"><?= $errors['username'] ?></p>
                <?php endif; ?>
            
            <label for="email" class="input__label">E-mail:</label>
            <input  id="email" name="email" class="input__field border-1 border-blue-500 rounded-md px-2 py-1" 
            value="<?php echo isset($_GET["email"]) ? htmlspecialchars($_GET["email"])  :'' ?>" minlength="1" maxlength="1000" required>
                <?php if (isset($errors['email'])): ?> 
                    <p class="text-red-500 font-bold text-sm mt-2"><?= $errors['email'] ?></p>
                <?php endif; ?>

            
            <label for="password" class="input__label">Password:</label>
            <input type="password" id="password" name="password" class="input__field border-1 border-blue-500 rounded-md px-2 py-1" minlength="1" maxlength="50" required>
                <?php if (isset($errors['password'])): ?> 
                    <p class="text-red-500 font-bold text-sm mt-2"><?= $errors['password'] ?></p>
                <?php endif; ?>
            
            <button type="submit" id="register" name="register" class="btn size-fit self-center my-4 px-4 py-1 border-1 border-blue-400 bg-blue-400 hover:bg-blue-200 rounded-md hover:cursor-pointer">Register</button>
            <div>
                <p>You already have an account? </p>
                <a href='/login' class="link size-fit self-center my-4  py-1 text-blue-400 hover:text-blue-700 "> Log In </a>
            </div>
        </form>
    </div>
</div>

<?php 
$content = ob_get_clean();
include 'layout.view.php';
?>