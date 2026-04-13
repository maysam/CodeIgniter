CREATE DATABASE IF NOT EXISTS ci_weblog;
USE ci_weblog;

CREATE TABLE IF NOT EXISTS users (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  display_name VARCHAR(100) NOT NULL,
  role ENUM('admin', 'author') NOT NULL DEFAULT 'author',
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS posts (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  user_id INT UNSIGNED NOT NULL,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL,
  excerpt TEXT NULL,
  body MEDIUMTEXT NOT NULL,
  status ENUM('draft', 'published') NOT NULL DEFAULT 'draft',
  published_at DATETIME NULL,
  created_at DATETIME NOT NULL,
  updated_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uniq_slug (slug),
  KEY idx_status_published_at (status, published_at),
  CONSTRAINT fk_posts_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS comments (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  post_id INT UNSIGNED NOT NULL,
  author_name VARCHAR(100) NOT NULL,
  author_email VARCHAR(150) NOT NULL,
  body TEXT NOT NULL,
  is_approved TINYINT(1) NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  KEY idx_post_approved (post_id, is_approved),
  CONSTRAINT fk_comments_post FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS ci_sessions (
  session_id VARCHAR(40) NOT NULL DEFAULT '0',
  ip_address VARCHAR(45) NOT NULL DEFAULT '0',
  user_agent VARCHAR(120) NOT NULL,
  last_activity INT UNSIGNED NOT NULL DEFAULT 0,
  user_data TEXT NOT NULL,
  PRIMARY KEY (session_id),
  KEY last_activity_idx (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  (1, 'Student Two', 'student2@example.com', 'Looking forward to testing this app.', 1, NOW())
ON DUPLICATE KEY UPDATE body = VALUES(body), created_at = VALUES(created_at);
