<article class="post-card">
    <h2>Admin Dashboard</h2>
    <p>Manage posts and content status.</p>
    <p><a class="btn" href="<?php echo site_url('admin/posts/create'); ?>">Create New Post</a></p>
</article>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Status</th>
            <th>Author</th>
            <th>Updated</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo $post['title']; ?></td>
                <td><?php echo $post['status']; ?></td>
                <td><?php echo $post['author_name']; ?></td>
                <td><?php echo $post['updated_at']; ?></td>
                <td>
                    <a href="<?php echo site_url('admin/posts/edit/'.$post['id']); ?>">Edit</a> |
                    <a href="<?php echo site_url('admin/posts/delete/'.$post['id']); ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
