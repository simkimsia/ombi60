#!/bin/bash

# this one needs to be changed according to server path
STAGING_PATH="/opt/lampp/htdocs/wp"
# currently we dont want to update the production on daily basis so we leave that out first
PRODUCTION_PATH=""


MYSPREE2SHOP_PATH="";

if [ $1 == "staging" ]
then
	MYSPREE2SHOP_PATH=$STAGING_PATH
fi

LOG_FILE_PATH="${MYSPREE2SHOP_PATH}/cron/logs/log.txt"

echo "Updating myspree2shop" > $LOG_FILE_PATH
date >> $LOG_FILE_PATH
svn update $MYSPREE2SHOP_PATH >> $LOG_FILE_PATH 2>&1

# now we also restore the database if its staging project
if [ $1 == "staging" ]
then

	DBHOST="127.0.0.1"
	DBUSERNAME="s2s"
	DBPASSWORD="StHDKWdEm834DQYB"
	DBNAME="s2s_staging"
	MYSQL="mysql -h ${DBHOST} -u ${DBUSERNAME} -p${DBPASSWORD} -D ${DBNAME}"
	$MYSQL -BNe "show tables" | awk '{print "set foreign_key_checks=0; drop table `" $1 "`;"}' | $MYSQL
	mysql -u ${DBUSERNAME} -p${DBPASSWORD} ${DBNAME} < ${MYSPREE2SHOP_PATH}/docs/database/staging_copy.sql
	unset MYSQL
	echo "Database cleared and restored" > $LOG_FILE_PATH

fi



