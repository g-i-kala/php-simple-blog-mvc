<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = "Home - My Blog";
ob_start();

?>
<div>
    <div class="header__wrapper mx-auto py-8">
        <h1 class="font-bold">Welcome, <?php echo htmlspecialchars($_SESSION['username']) ?>! </h1>
    </div>

    <div class="display__posts">
        
    </div>

    <div class="form__add__post my-4">
        <form method="POST" action="/add_post" id="add_post" name="add_post" class="flex flex-col">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="input__field border-1 border-blue-500 rounded-md" required>
            
            <label for="content">Post content:</label>
            <textarea name="content" id="content" class="input__textarea border-1 border-blue-500 rounded-md" required></textarea>
            
            <button type="submit" id="add_post" name="add_post" class="btn size-fit my-4 px-4 py-1 border-1 border-blue-400 bg-blue-400 hover:bg-blue-200 rounded-md hover:cursor-pointer">Add Post</button>
        </form>        
             
    </div>
    <div id="user-posts" class="user__posts">
        <!-- get the posts
            loop through the posts 
            &display them  
        -->
            
            <div class="posts flex flex-col gap-2">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2 class="text-lg font-bold py-2"><?= htmlspecialchars($post['title']); ?></h2>
                    <p class="text-normal"><?= htmlspecialchars($post['content']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>         
    </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>