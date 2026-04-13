<article class="post-card">
    <h2>Login</h2>
    <p>Use demo credentials from the README to manage blog posts.</p>

    <?php if (!empty($error)): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="<?php echo site_url('login'); ?>">
        <div class="field">
            <label for="username">Username</label>
            <input id="username" type="text" name="username">
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password">
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</article>
