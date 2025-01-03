#!/bin/bash
set -e

host="$1"
shift
cmd="$@"

echo "$host $MYSQL_USER $MYSQL_PASSWORD"

until mysql -h"$host" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" -e "select 1" > /dev/null 2>&1; do
  >&2 echo "MySQL is unavailable - sleeping"
  sleep 1
done

>&2 echo "MySQL is up - executing command"
exec $cmd