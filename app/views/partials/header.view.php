
<div class="flex flex-row justify-between items-center p-4 bg-blue-500 text-white">
    <a href="/dashboard">
        <h1 class="text-2xl font-bold">My Blog</h1>
    </a>
    

    <?php if(isset($_SESSION['user_id'])) : ?>
        <div class="logout__wrapper">
            <form id="logout-form" action="/logout" method="POST" style="display: none;">
            </form>
            <button form="logout-form" type="submit" class="btn size-fit self-center my-4 px-4 py-1 border-1 border-blue-400 bg-blue-400 hover:bg-blue-200 rounded-md hover:cursor-pointer">Logout</button>
        </div>
    <?php endif; ?>    
</div>