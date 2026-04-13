<article class="post-card">
    <h2><?php echo $title; ?></h2>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="field">
            <label for="title">Title</label>
            <input id="title" type="text" name="title" value="<?php echo $post['title']; ?>">
        </div>

        <div class="field">
            <label for="slug">Slug</label>
            <input id="slug" type="text" name="slug" value="<?php echo $post['slug']; ?>">
        </div>

        <div class="field">
            <label for="excerpt">Excerpt</label>
            <textarea id="excerpt" name="excerpt" rows="2"><?php echo $post['excerpt']; ?></textarea>
        </div>

        <div class="field">
            <label for="body">Body</label>
            <textarea id="body" name="body" rows="10"><?php echo $post['body']; ?></textarea>
        </div>

        <div class="field">
            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="draft" <?php echo $post['status'] === 'draft' ? 'selected' : ''; ?>>Draft</option>
                <option value="published" <?php echo $post['status'] === 'published' ? 'selected' : ''; ?>>Published</option>
            </select>
        </div>

        <div class="field">
            <label for="published_at">Published At (optional YYYY-MM-DD HH:MM:SS)</label>
            <input id="published_at" type="text" name="published_at" value="<?php echo $post['published_at']; ?>">
        </div>

        <button type="submit" class="btn">Save Post</button>
    </form>
</article>
