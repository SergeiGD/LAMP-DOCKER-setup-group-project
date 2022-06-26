from flask import Flask, render_template, request, url_for, redirect
from flaskext.mysql import MySQL
import conf


app = Flask(__name__)
mysql = MySQL()

app.config['MYSQL_DATABASE_PORT'] = int(conf.MYSQL_DB_PORT)
app.config['MYSQL_DATABASE_USER'] = conf.MYSQL_DB_USER
app.config['MYSQL_DATABASE_PASSWORD'] = conf.MYSQL_DB_PASSWD
app.config['MYSQL_DATABASE_DB'] = conf.MYSQL_DB_NAME
app.config['MYSQL_DATABASE_HOST'] = 'localhost'

mysql.init_app(app)


@app.route("/")
def index():
    conn = mysql.connect()
    cursor = conn.cursor()

    if "create" in request.args:
        name = request.args.get("name_create")
        email = request.args.get("email_create")
        phone = "'" + request.args.get("phone_create") + "'" if request.args.get("phone_create") != "" else "NULL"
        cursor.execute(f"INSERT INTO users (user_name, email, phone_num) VALUES ('{name}', '{email}', {phone})")
        conn.commit()

    if "edit" in request.args:
        id = request.args.get("id")
        return redirect(url_for("edit", id=id))

    if "delete" in request.args:
        id = request.args.get("id")
        cursor.execute(f"DELETE FROM users WHERE user_id = {id}")
        conn.commit()

    cursor.execute("SELECT * from users ORDER BY user_id")
    data = cursor.fetchall()

    conn.close()
    cursor.close()
    return render_template('index.html', users = data)


@app.route("/edit")
def edit():
    conn = mysql.connect()
    cursor = conn.cursor()
    id = request.args.get("id")

    if "edit" in request.args:
        name = request.args.get("name_edit")
        email = request.args.get("email_edit")
        phone = "'" + request.args.get("phone_edit") + "'" if request.args.get("phone_edit") != "" and request.args.get("phone_edit") != "None" else "NULL"
        cursor.execute(f"UPDATE users SET user_name = '{name}', email = '{email}', phone_num = {phone} WHERE user_id = {id}")
        conn.commit()
        conn.close()
        cursor.close()
        return redirect(url_for("index"))

    cursor.execute(f"SELECT * from users WHERE user_id = {id}")
    data = cursor.fetchone()
    conn.close()
    cursor.close()
    return render_template('edit.html', user=data)


if __name__ == "__main__":
    app.run(host='0.0.0.0')