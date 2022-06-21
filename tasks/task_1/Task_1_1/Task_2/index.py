#for index.py
from flask import Flask, render_template, request, redirect #import mysql & flask
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
	id = request.args.get("id")


	if "delete" in request.args:						#delete query
		id = request.args.get("id")
		cursor.execute(f"DELETE FROM Users WHERE id = {id}")
		conn.commit()
		conn.close()
		cursor.close()
		return redirect(f"http://127.0.0.1:8082/")

	cursor.execute(f"SELECT * FROM Users WHERE id = {id}")			#select query
	result = cursor.fetchall()

	conn.close()										#close cursor & connection
	cursor.close()
	return render_template('index.html', user = result)

if __name__ == "__main__":
	app.run(host='0.0.0.0')
