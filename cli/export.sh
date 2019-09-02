#!/bin/bash
set -e
echo " to export!"


_os="`uname`"
_now=$(date +"%m_%d_%Y")
_file="../wp-data/data_$_now.sql"

mkdir -p '../wp-data'
# Export dump
#docker exec 05b143340b1c /usr/bin/mysqldump --add-drop-table  -u wordpress --password=wordpress wordpress > db/wp_db2.sql 
# EXPORT_COMMAND='exec mysqldump myapp -u root -ppassword'

EXPORT_COMMAND='exec mysqldump "$MYSQL_DATABASE" -uroot -p"$MYSQL_ROOT_PASSWORD"'

docker-compose exec mysql sh -c "$EXPORT_COMMAND" > $_file



if [[ $_os == "Darwin"* ]] ; then
  sed -i '.bak' 1,1d $_file
else
  sed -i 1,1d $_file # Removes the password warning from the file
fi

echo " exported !!!"
