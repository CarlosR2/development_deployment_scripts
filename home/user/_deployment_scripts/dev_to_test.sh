#! /bin/bash

# Sync files from dev to test
# Adjust permissons folders
# Run install.php for db changes

echo 'Starting installation dev to test'

DEV_FOLDER="/home/user/public_html_dev/"
TEST_FOLDER="/home/user/public_html_test/"


#make a folder copy
BACKUP_FOLDER="/home/user/_backups/test/$(date +%s)/"
echo "Making backup of src and sql to ${BACKUP_FOLDER}"
mkdir ${BACKUP_FOLDER}
#cp -a ${CURRENT_FOLDER}. ${BACKUP_FOLDER}
rsync -av --exclude=.git --exclude=tmp  ${TEST_FOLDER} ${BACKUP_FOLDER}

#make a sql copy
mysqldump -u Db_USER_TEST -pDB_USER_PASS_TEST DB_NAME_TEST > ${BACKUP_FOLDER}mysql_backup.sql

#copy contents from dev to test
rsync -av --exclude=.git --exclude=tmp  ${DEV_FOLDER} ${TEST_FOLDER}

#now install database changes
php -f ${TEST_FOLDER}install/install_db.php test

#now install file permissions # PASAR ARGUMENT FOLDER
chmod +x ${TEST_FOLDER}install/folder_permissions.sh
sh /${TEST_FOLDER}install/folder_permissions.sh ${TEST_FOLDER}


#Lets get back
cd /home/user/_deployment_scripts
echo "Install Finished"
exit
