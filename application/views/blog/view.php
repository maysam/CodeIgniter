<article class="post-card">
    <h2><?php echo $post['title']; ?></h2>
    <p class="meta">By <?php echo $post['author_name']; ?> on <?php echo $post['published_at']; ?></p>
    <p><?php echo $post['body']; ?></p>
    <p><a class="post-link" href="<?php echo site_url('blog'); ?>">&larr; Back to all posts</a></p>
</article>

<article class="post-card">
    <h3>Comments</h3>
    <?php if (empty($comments)): ?>
        <p>No comments yet.</p>
    <?php endif; ?>

    <?php foreach ($comments as $comment): ?>
        <div style="margin-bottom: 16px; border-bottom: 1px solid #e5e7eb; padding-bottom: 12px;">
            <p class="meta"><?php echo $comment['author_name']; ?> (<?php echo $comment['author_email']; ?>) at <?php echo $comment['created_at']; ?></p>
            <p><?php echo $comment['body']; ?></p>
        </div>
    <?php endforeach; ?>

    <h3>Leave a comment</h3>
    <form method="post" action="<?php echo site_url('blog/'.$post['slug']); ?>">
        <div class="field">
            <label for="author_name">Name</label>
            <input id="author_name" type="text" name="author_name">
        </div>
        <div class="field">
            <label for="author_email">Email</label>
            <input id="author_email" type="email" name="author_email">
        </div>
        <div class="field">
            <label for="comment_body">Comment</label>
            <textarea id="comment_body" name="body" rows="4"></textarea>
        </div>
        <button type="submit" class="btn">Submit Comment</button>
    </form>
</article>
