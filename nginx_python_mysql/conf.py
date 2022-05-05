import os
from os.path import join, dirname
from dotenv import load_dotenv

dotenv_path = join(dirname(__file__), '.env')
load_dotenv(dotenv_path)


MYSQL_DB_NAME = os.environ.get('DB_NAME')
MYSQL_DB_PORT = os.environ.get('DB_PORT')
MYSQL_DB_PASSWD = os.environ.get('DB_PASSWD')
MYSQL_DB_USER = os.environ.get('DB_USER')

