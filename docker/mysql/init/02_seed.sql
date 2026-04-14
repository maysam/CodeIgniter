USE ci_weblog;

INSERT INTO users (username, password_hash, display_name, role, created_at)
VALUES
  ('admin', SHA1('admin123'), 'Demo Admin', 'admin', NOW()),
  ('editor', SHA1('editor123'), 'Demo Editor', 'author', NOW())
ON DUPLICATE KEY UPDATE username = VALUES(username);

INSERT INTO posts (user_id, title, slug, excerpt, body, status, published_at, created_at, updated_at)
VALUES
  (1, 'Welcome to the Training Weblog', 'welcome-to-the-training-weblog', 'A starter post for the pentesting training target.', 'This demo weblog is built with CodeIgniter 2.2.0 and MySQL. It includes login, post management, and public comments so students can practice assessing a real PHP MVC app.', 'published', NOW(), NOW(), NOW()),
  (2, 'Code Review Checklist', 'code-review-checklist', 'Things to inspect in old PHP codebases.', 'When reviewing legacy apps, inspect input validation, auth logic, session handling, database queries, file upload handling, and output escaping behavior.', 'published', NOW(), NOW(), NOW()),
  (1, 'Draft: Internal Roadmap', 'draft-internal-roadmap', 'Internal planning note.', 'This draft is visible in admin only until published.', 'draft', NULL, NOW(), NOW())
ON DUPLICATE KEY UPDATE title = VALUES(title), excerpt = VALUES(excerpt), body = VALUES(body), status = VALUES(status), updated_at = VALUES(updated_at);

INSERT INTO comments (post_id, author_name, author_email, body, is_approved, created_at)
VALUES
  (1, 'Student One', 'student1@example.com', 'Thanks for providing this training target.', 1, NOW()),
  (1, 'Student Two', 'student2@example.com', 'Looking forward to testing this app.', 1, NOW());
