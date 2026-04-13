<?php if (empty($posts)): ?>
    <article class="post-card">
        <h2>No published posts yet</h2>
        <p>Login and create your first post from the admin dashboard.</p>
    </article>
<?php endif; ?>

<?php foreach ($posts as $post): ?>
    <article class="post-card">
        <h2>
            <a href="<?php echo site_url('blog/'.$post['slug']); ?>"><?php echo $post['title']; ?></a>
        </h2>
        <p class="meta">By <?php echo $post['author_name']; ?> on <?php echo $post['published_at']; ?></p>
        <p><?php echo character_limiter($post['excerpt'] !== '' ? $post['excerpt'] : $post['body'], 200); ?></p>
        <p><a class="post-link" href="<?php echo site_url('blog/'.$post['slug']); ?>">Read more</a></p>
    </article>
<?php endforeach; ?>
