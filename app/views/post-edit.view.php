<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = "Edit the post";
ob_start();

?>

<div id="edit__post__section" class="post__edit__modal">
    <h1 class="text-2xl font-bold pt-4 ">Edit Post Section</h1>
    <?php if (isset($_SESSION['edit_post_data'])): ?>
        <?php $edit_post = $_SESSION['edit_post_data']?>
        <form action="/post/update" method="POST"  id="post_update" name="post_update" class="flex flex-col mt-4 space-y-1">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($_SESSION['edit_post_id']); ?>">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($edit_post['title']); ?>" class="input__field border-1 border-blue-500 rounded-md px-2 py-1" required>
            
            <label for="content">Post content:</label>
            <textarea name="content" id="content" class="input__textarea border-1 border-blue-500 rounded-md px-2 py-1" required><?php echo htmlspecialchars($edit_post['content']); ?></textarea>
               
            <div class="flex-inline">
                <button type="submit" id="update_post" name="action" value="post_update" class="text-white size-fit my-4 px-4 py-1 border-1 bg-blue-400 hover:bg-blue-200 rounded-md hover:cursor-pointer">Update Post</button>
                <a href="/dashboard" class="btn size-fit my-4 px-4 py-1  bg-white hover:bg-blue-200 rounded-md hover:cursor-pointer">Cancel</a>
            </div>
        </form>   
    
    <?php   unset($_SESSION['edit_post_data']);
            unset($_SESSION['edit_post_id']); ?>
    <?php else: ?>
        <?php if (isset($errors['no_post'])): ?>
            <p class="text-red-500 font-bold font-sm">
                <?= $errors['no_post'] ?>
            </p>
        <?php else: ?>
            <p>No post selected for editing.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>


<?php
$content = ob_get_clean();
include 'layout.view.php';
?>