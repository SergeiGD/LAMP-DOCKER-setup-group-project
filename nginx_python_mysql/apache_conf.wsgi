import sys
sys.path.insert(0,"/var/www/LAMP-setup-group-project/nginx_python_mysql")
sys.path.append("/var/www/LAMP-setup-group-project/nginx_python_mysql/env/lib/python3.8/site-packages")

from index import app as application
