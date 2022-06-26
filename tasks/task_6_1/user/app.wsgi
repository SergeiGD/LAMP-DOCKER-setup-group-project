import sys
sys.path.insert(0, "/var/www/lamp/project_mysql_apache/user")
sys.path.append("/var/www/lamp/project_mysql_apache/user/env/lib/python3.8/site-packages")

from user import app as application
