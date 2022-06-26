import sys
sys.path.insert(0, "/var/www/lamp/project_mysql_apache/main")
sys.path.append("/var/www/lamp/project_mysql_apache/main/env/lib/python3.8/site-packages")

from index import app as application
