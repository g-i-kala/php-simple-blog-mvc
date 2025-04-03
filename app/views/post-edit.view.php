<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$title = "Edit the post";
ob_start();

?>

<div id="edit__post__section" class="post__edit__modal">
    <h1 class="text-2xl font-bold pt-4 border-t-2 border-blue-400">Edit Post Section</h1>
    <?php if (isset($_SESSION['edit_post_data'])): ?>
        <?php $edit_post = $_SESSION['edit_post_data']?>
        <h1 class="text-xl font-bold pt-4">Edit <?= $edit_post['title'] ?> post</h1>
        <form action="/update_post" method="POST"  id="update_post" name="update_post" class="flex flex-col">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($edit_post['title']); ?>" class="input__field border-1 border-blue-500 rounded-md px-2 py-1" required>
            
            <label for="content">Post content:</label>
            <textarea name="content" id="content" class="input__textarea border-1 border-blue-500 rounded-md px-2 py-1" required>
                <?php echo htmlspecialchars($edit_post['content']); ?>
            </textarea>
               
            <button type="submit" id="update_post" name="action" value="update_post" class="btn size-fit my-4 px-4 py-1 border-1 border-blue-400 bg-blue-400 hover:bg-blue-200 rounded-md hover:cursor-pointer">Update Post</button>
        </form>   
    
    <?php unset($_SESSION['edit_post_data']); ?>
    <?php else: ?>
        <p>No post selected for editing.</p>
    <?php endif; ?>
</div>


<?php
$content = ob_get_clean();
include 'layout.view.php';
?>