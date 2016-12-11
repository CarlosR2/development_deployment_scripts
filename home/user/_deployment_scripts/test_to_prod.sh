#! /bin/bash

# copy new files
# modify folder permissions
# install bd
# delete install folder

echo 'Starting installation test to prod'

TEST_FOLDER="/home/user/public_html_test/"
PROD_FOLDER="/home/user/public_html/"


#make a folder copy
BACKUP_FOLDER="/home/user/_backups/prod/$(date +%s)/"
echo "Making backup of src and sql to ${BACKUP_FOLDER}"
mkdir ${BACKUP_FOLDER}
#cp -a ${CURRENT_FOLDER}. ${BACKUP_FOLDER}
rsync -av --exclude=.git --exclude=beta --exclude=imagenes/cache ${PROD_FOLDER} ${BACKUP_FOLDER}

#make a sql copy
mysqldump -u DB_USER -pDB_USER_PASS DB_NAME  > ${BACKUP_FOLDER}mysql_backup.sql

#copy contents from test to prod
rsync -av --exclude=tmp --exclude=imagenes  ${TEST_FOLDER} ${PROD_FOLDER}

#now install database changes
php -f ${PROD_FOLDER}install/install_db.php prod

#now install file permissions # PASAR ARGUMENT FOLDER
chmod +x ${PROD_FOLDER}install/folder_permissions.sh
sh /${PROD_FOLDER}install/folder_permissions.sh ${TEST_FOLDER}

#remove installation folder

rm -Rf /${PROD_FOLDER}install
rm ${PROD_FOLDER}robots.txt
#Lets get back
cd /home/user/_deployment_scripts
echo "Install Finished"
exit
