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
            <input type="text" name="title" id="title" class="input__field border-1 border-blue-500 rounded-md px-2 py-1" required>
                <?php if (isset($errors['title'])): ?> 
                    <p class="text-red-500 font-bold text-sm mt-2"><?= $errors['title'] ?></p>
                <?php endif; ?>
        
            <label for="content">Post content:</label>
            <textarea name="content" id="content" class="input__textarea border-1 border-blue-500 rounded-md px-2 py-1" required></textarea>
                <?php if (isset($errors['content'])): ?> 
                    <p class="text-red-500 font-bold text-sm mt-2"><?= $errors['content'] ?></p>
                <?php endif; ?>
            <button type="submit" id="add_post" name="add_post" class=" text-white size-fit my-4 px-4 py-1 bg-blue-400 hover:bg-blue-300 rounded-md hover:cursor-pointer">Add Post</button>
        </form>        
             
    </div>
    <div id="user-posts" class="user__posts">
            
        <div class="posts flex flex-col gap-2 py-4">
            <?php foreach ($posts as $post): ?>
                <div class="post flex flex-row justify-between">
                    <div class = "post__content flex flex-col">
                        <h2 class="text-lg font-bold py-2"><?= htmlspecialchars($post['title']); ?></h2>
                        <p class="text-normal"><?= htmlspecialchars($post['content']); ?></p>
                    </div>
                    <div class="post__edit flex flex-col text-white">
                        <form action="/post/edit" method="POST" id="post_edit" class="">
                            <input type=hidden name="post_id" value="<?php echo htmlspecialchars($post['id']) ?>">
                            <button type="submit" name="action" value="post_edit" class="w-full my-2 px-4 py-1 bg-green-500 hover:bg-green-400 rounded-md hover:cursor-pointer">Edit</button>
                        </form>
                        <form action="/post/delete" method="POST" id="post_delete" class="">
                            <input type=hidden name="post_id" value="<?php echo htmlspecialchars($post['id']) ?>">
                            <button type="submit" name="post_delete" class="my-2 px-4 py-1 bg-red-400 hover:bg-red-600 rounded-md hover:cursor-pointer">Delete</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div> 
    </div>
</div>

<?php
$content = ob_get_clean();
include 'layout.view.php';
?>