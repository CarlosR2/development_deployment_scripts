# Deployment scripts for a server with 3 environments: DEV (development), TEST (test) & PROD (production)

This is a collection of scripts that I use to manage environments while development cycle of a web app.

I create 3 environments and manage the access via Apache configuration file

Environments:

* Production: yourdomain.com (public_html) > production
* Test: test.yourdomain.com (public_html_test) > for testers
* Dev: dev.yourdomain.com (public_html_dev) > for developers


The cycle goes like this

* Developers develope locally on their machines. "install" folder is in the project
* They commit & push to git server (Git server should be also on web server machine)
* In the server execute "git_to_dev.sh" > This will download code to git_repo (cloned repo) folder and put on development environment and will updated db
+ When code in development env is good, execute "dev_to_test.sh" > this will copy code from dev to test folder and will update db
+ When code in test env is good, execute "test_to_prod.sh" > this will copy code from dev to test folder and will update db


In each step 

* A backup (sql & files) is created
* Files are copied
* The database is updated (the scheme is defined in install/install_db.php, so keep it up to date when you make changes to database tables)
* The folder permissions are updated (so keep it up to date when you make changes to permissions)


Also, in the app, the configuration files will read the current domain and will set the right vars for the environment.

Hope it helps!