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
