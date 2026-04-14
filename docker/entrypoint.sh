#!/bin/sh
set -eu

DB_HOST="${DB_HOST:-mysql}"
DB_PORT="${DB_PORT:-3306}"
DB_NAME="${DB_NAME:-ci_weblog}"
DB_USER="${DB_USER:-ci_user}"
DB_PASSWORD="${DB_PASSWORD:-ci_password}"

mysql_ready() {
    MYSQL_PWD="$DB_PASSWORD" mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" --silent >/dev/null 2>&1
}

mysql_exec() {
    MYSQL_PWD="$DB_PASSWORD" mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USER" "$@"
}

ensure_session_table() {
    attempts=0

    until mysql_ready; do
        attempts=$((attempts + 1))

        if [ "$attempts" -ge 30 ]; then
            echo "MySQL did not become ready before Apache startup." >&2
            return
        fi

        sleep 2
    done

    if ! mysql_exec -Nse "SHOW DATABASES LIKE '$DB_NAME';" 2>/dev/null | grep -q "^$DB_NAME$"; then
        echo "Database $DB_NAME is not available yet; skipping session table bootstrap." >&2
        return
    fi

    if mysql_exec -D "$DB_NAME" -Nse "SHOW TABLES LIKE 'ci_sessions';" 2>/dev/null | grep -q '^ci_sessions$'; then
        return
    fi

    if ! mysql_exec -D "$DB_NAME" -e "
        CREATE TABLE IF NOT EXISTS ci_sessions (
            session_id VARCHAR(40) NOT NULL DEFAULT '0',
            ip_address VARCHAR(45) NOT NULL DEFAULT '0',
            user_agent VARCHAR(120) NOT NULL,
            last_activity INT UNSIGNED NOT NULL DEFAULT 0,
            user_data TEXT NOT NULL,
            PRIMARY KEY (session_id),
            KEY last_activity_idx (last_activity)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    "; then
        echo "Could not create ci_sessions automatically." >&2
    fi
}

ensure_session_table

exec "$@"
