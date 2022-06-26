#for index.py
from flask import Flask, render_template, request #import mysql & flask
from flaskext.mysql import MySQL

app = Flask(__name__, template_folder='templates')
mysql = MySQL()
app.config['MYSQL_DATABASE_USER'] = 'egor'					#db connection
app.config['MYSQL_DATABASE_PASSWORD'] = 'Rasmus1love'
app.config['MYSQL_DATABASE_DB'] = 'testDB'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
mysql.init_app(app)

@app.route("/")
def index():
	conn = mysql.connect()			#cursor delcaration & connection
	cursor =conn.cursor()
	pagemax = 4
	prev = False
	next = False
	row = 0

	cursor.execute(f"SELECT * FROM Users ORDER BY id")
	result = cursor.fetchmany(size=4)
	cursor.execute(f"SELECT count(*) FROM Users")
	row_count = cursor.fetchone()

	if "add" in request.args:					
		login = request.args.get("login_add")
		name = request.args.get("name_add")
		cursor.execute(f"INSERT INTO Users (login, name) VALUES ('{login}', '{name}')")
		conn.commit()

	if "edit" in request.args:							
		id = request.args.get("id")
		login = request.args.get("login_edit")
		name = request.args.get("name_edit")
		cursor.execute(f"UPDATE Users SET login = '{login}', name = '{name}' WHERE id = {id}")
		conn.commit()

	if "next" in request.args:
		if 'page' in request.args:
			row = int(request.args.get('page'))
		row += 4
		cursor.execute(f"SELECT * FROM Users ORDER BY id  LIMIT {pagemax} OFFSET {row}")
		result = cursor.fetchall()

	if "back" in request.args:
		if 'page' in request.args:
			row = int(request.args.get('page'))
		row -= 4

	if row >= 4:
		prev = True	
	else:
		prev = False
		
	if row == int(row_count[0]) - 4 or row == int(row_count[0]) - 3 or row == int(row_count[0]) - 2 or row == int(row_count[0]) - 1:
		next = False
	else:
		next = True

	conn.close()										
	cursor.close()
	return render_template('index.html', users = result, check_prev = prev, check_next = next, page = row)

if __name__ == "__main__":
	app.run(host='0.0.0.0')
