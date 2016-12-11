
# in: git pull
# copy newer files excluding .git
# run install/install.php
# run install/folder_permissions

#!/bin/sh

# Sync files from dev to test
# Adjust permissons folders
# Run install.php for db changes

echo 'Starting installataion git to dev'

CURRENT_FOLDER="/home/user/public_html_dev/"
GIT_FOLDER="/home/user/git_repo_clone/"
echo $CURRENT_FOLDER
cd $CURRENT_FOLDER

# check if we avoid backup
make_backup=${1}
echo make_backup;

if [ "$make_backup" = "backup" ]; then
#make a folder copy
BACKUP_FOLDER="/home/user/_backups/dev/$(date +%s)/"
echo "Making backup of src and sql to ${BACKUP_FOLDER}"
mkdir ${BACKUP_FOLDER}
#cp -a ${CURRENT_FOLDER}. ${BACKUP_FOLDER}
rsync -av --exclude=.git --exclude=tmp  ${CURRENT_FOLDER} ${BACKUP_FOLDER}
#make a sql copy
mysqldump -u DB_USER_DEV -pDB_USER_PASS_DEV DB_NAME_DEV > ${BACKUP_FOLDER}mysql_backup.sql
fi

#download new code
echo "Downloading the new code"
cd $GIT_FOLDER
git pull origin master
cd $CURRENT_FOLDER
rsync -av --exclude=.git --exclude=tmp  ${GIT_FOLDER} ${CURRENT_FOLDER}

#now install database changes
chmod 755 ${CURRENT_FOLDER}install/install_db.php
php -f ${CURRENT_FOLDER}install/install_db.php dev

#now install file permissions # PASAR ARGUMENT FOLDER
chmod +x ${CURRENT_FOLDER}install/folder_permissions.sh
sh ${CURRENT_FOLDER}install/folder_permissions.sh ${CURRENT_FOLDER}


#Lets get back
cd /home/user/_deployment_scripts
echo "Install Finished"
exit
