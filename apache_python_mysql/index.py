from flask import Flask, render_template, request
from flaskext.mysql import MySQL

app = Flask(__name__)
mysql = MySQL()
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = 'passwd'
app.config['MYSQL_DATABASE_DB'] = 'users'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
mysql.init_app(app)

@app.route("/")
def index():
	conn = mysql.connect()
	cursor =conn.cursor()

	if "create" in request.args:
		name = request.args.get("name_create")
		email = request.args.get("email_create")
		cursor.execute(f"INSERT INTO users_table (name, email) VALUES ('{name}', '{email}')")
		conn.commit()

	if "edit" in request.args:
		id = request.args.get("id")
		name = request.args.get("name_edit")
		email = request.args.get("email_edit")
		cursor.execute(f"UPDATE users_table SET name = '{name}', email = '{email}' WHERE id = {id}")
		conn.commit()

	if "delete" in request.args:
		id = request.args.get("id")
		cursor.execute(f"DELETE FROM users_table WHERE id = {id}")
		conn.commit()

	cursor.execute("SELECT * FROM users_table")
	result = cursor.fetchall()

	conn.close()
	cursor.close()
	return render_template('index.html', users = result)

if __name__ == "__main__":
	app.run(host='0.0.0.0')
