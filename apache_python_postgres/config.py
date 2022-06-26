from os import getenv
from dotenv import load_dotenv


load_dotenv()


config = {
    "DB_HOST" : getenv('DB_HOST'),
    "DB_NAME" : getenv('DB_NAME'),
    "DB_USER" : getenv('DB_USER'),
    "PGSQL_DB_PASSWORD" : getenv('PGSQL_DB_PASSWORD'),
    "SECRET_KEY" : getenv('SECRET_KEY'),
    "PGSQL_PORT" : getenv('PGSQL_PORT')
}


if __name__ == '__main__':
    print(config)
    