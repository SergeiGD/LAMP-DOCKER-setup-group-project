import psycopg2

from config import config

from flask import Flask, render_template, request, url_for, flash, redirect
from werkzeug.exceptions import abort


app = Flask(__name__)


app.config['SECRET_KEY'] = config['SECRET_KEY']


@app.route('/')
def index():
    return render_template('index.html')


@app.route('/users/user', methods=('GET', 'POST'))
def post():
    user_id = request.args.get('user_id', default=1, type=str)
    
    user = get_user(user_id)
    
    return render_template('user.html', user=user)


@app.route('/users')
def users():
    conn = get_postgres_connection()
    cursor = conn.cursor()

    cursor.execute('SELECT * FROM users;')

    users = cursor.fetchall()

    cursor.close()
    conn.close()
    
    return render_template('users.html', users=users)


@app.route('/users/create', methods=('GET', 'POST'))
def create():
    if request.method == 'POST':
        login = request.form['login']
        password = request.form['password']

        if not login:
            flash('Login is required!')
        elif not password:
            flash('Password is required!')
        else:
            conn = get_postgres_connection()

            cur = conn.cursor()

            cur.execute('INSERT INTO users (login, password) VALUES (%s, %s)',
                        (login, password))
            conn.commit()

            cur.close()
            conn.close()

            return redirect(url_for('users'))

    return render_template('create.html')


@app.route('/edit', methods=('GET', 'POST'))
def edit():
    user_id = request.args.get('id', default=1, type=str)
    user = get_user(user_id)

    if request.method == 'POST':
        login = request.form['login']
        password = request.form['password']

        if not login:
            flash('Login is required!')
        elif not password:
            flash('Password is required!')
        else:
            conn = get_postgres_connection()
            
            cur = conn.cursor()

            cur.execute('UPDATE users SET login = %s, password = %s WHERE id = %s;',
                        (login, password, user_id))
            conn.commit()

            cur.close()
            conn.close()
            
            return redirect(url_for('users'))

    return render_template('edit.html', user=user)


@app.route('/delete', methods=('POST',))
def delete():
    user_id = request.args.get('user_id', default=None, type=str)
    user = get_user(user_id)
    
    if user:
        conn = get_postgres_connection()
        
        cur = conn.cursor()

        cur.execute(f'DELETE FROM users WHERE id = {user_id};')
        
        conn.commit()

        cur.close()
        conn.close()

        flash(f'"{user[1]}" was successfuly deleted!')

    return redirect(url_for('users'))


def get_postgres_connection():

    conn = psycopg2.connect(
        host=config['DB_HOST'],
        database=config['DB_NAME'],
        user=config['DB_USER'],
        password=config['PGSQL_DB_PASSWORD'],
        port=config['PGSQL_PORT']
    )
    
    return conn


def get_user(user_id):
    
    conn = get_postgres_connection()
    cur = conn.cursor()
    
    cur.execute(f'SELECT * FROM users WHERE id = {user_id};')

    user = cur.fetchone()

    cur.close()
    conn.close()

    if user is None:
        abort(404)
    return user


if __name__ == '__main__':
    app.run()
