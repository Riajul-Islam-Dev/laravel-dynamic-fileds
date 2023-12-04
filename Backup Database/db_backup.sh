#!/bin/bash

DB_HOST="127.0.0.1"
# DB_PORT="3306"
DB_USER="root"
DB_PASSWORD=""
DB_NAME="dynamic_fields_db"

BACKUP_PATH="D:/wamp64/www/laravel-dynamic-fields/Backup Database/backups"

MYSQLDUMP="D:/xampp/mysql/bin/mysqldump.exe"

# Check if the backup path exists
if [ ! -d "$BACKUP_PATH" ]; then
  echo "Backup path does not exist: $BACKUP_PATH"
  exit 1
fi

# Note: There should be a space after -p for password
# "$MYSQLDUMP" -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASSWORD" "$DB_NAME" > "$BACKUP_PATH/db_backup_$(date +"%Y%m%d").sql"

# If you encounter issues with password, try using the following format
"$MYSQLDUMP" -h "$DB_HOST" -u "$DB_USER" --password="$DB_PASSWORD" "$DB_NAME" > "$BACKUP_PATH/db_backup_$(date +"%Y%m%d").sql"

# Check if the dump was successful
if [ $? -eq 0 ]; then
  echo "Backup completed successfully."
else
  echo "Backup failed."
fi

# # gzip "$BACKUP_PATH/db_backup_$(date +"%Y%m%d").sql"
# set permission: chmod +x db_backup.sh
# # run: ./db_backup.sh