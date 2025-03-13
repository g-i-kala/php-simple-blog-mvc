<?php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@Blog Dashboard</title>
</head>
<body>
<div class="page__container">
    
<header>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']) ?>! </h1>
    </header>

    <div class="display__posts">
        
    </div>

    <div class="form__add__post">
        <form method="POST" action="/add_post" id="add_post" name="add_post">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="input__field" required>
            
            <label for="content">Post content:</label>
            <textarea name="content" id="content" class="input__textarea" required></textarea>
            
            <button type="submit" id="add_post" name="add_post" class="btn">Add Post</button>
        </form>        
             <div>
                <p>You done? Logout. </p>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                </form>
                <button form="logout-form" type="submit" class="btn">Logout</button>
            </div>
    </div>
    <div id="user-posts" class="user__posts">
        <!-- get the posts
            loop through the posts 
            &display them  
        -->
            
            <div class="posts">
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2><?= htmlspecialchars($post['title']); ?></h2>
                    <p><?= htmlspecialchars($post['content']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
            
            
    </div>

</body>
</html>