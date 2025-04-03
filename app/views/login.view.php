<?php
$title = "@Blog - Login";
ob_start();
?>  
  
<div class="page__container flex flex-col justify-center items-center">
    
    <div class="header__wrapper mx-auto py-8">
        <h1 class="">Welcome,
        
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success-message">
                <?= htmlspecialchars($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        
        please log in.</h1>
    </div>

    <div class="form__wrapper my-4">
        <form action="/login" method="POST" id="login-form" class="form__reglog flex flex-col">
            <label for="email" class="input__label">E-Mail:</label>
            <input type="text" id="email" name="email" class="input__field border-1 border-blue-500 rounded-md px-2 py-1"
            value="<?php echo isset($_GET["email"]) ? htmlspecialchars($_GET["email"]) : '';  ?>" required>
            <label for="password" class="input__label">Password:</label>
            <input type="password" id="password" name="password" class="input__field border-1 border-blue-500 rounded-md px-2 py-1" required>
            
            <!-- error messages -->
            <?php if (isset($_GET['error'])) : ?>
                <div class="error-message text-red-900 py-2">
                <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif;?>
            <button type="submit" id="login" name="login" class="btn size-fit self-center my-4 px-4 py-1 border-1 border-blue-400 bg-blue-400 hover:bg-blue-200 rounded-md hover:cursor-pointer">LogIn</button>
            <div>
                <p>You don't have an account? </p>
                <a href='/register' class="link size-fit self-center my-4  py-1 text-blue-400 hover:text-blue-700 "> Register </a>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.view.php';
?>