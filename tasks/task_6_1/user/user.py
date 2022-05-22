from flask import Flask, render_template, request, redirect
from flaskext.mysql import MySQL

app = Flask(__name__)
mysql = MySQL()
app.config['MYSQL_DATABASE_PORT'] = 8087
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = 'passwd'
app.config['MYSQL_DATABASE_DB'] = 'users'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
mysql.init_app(app)

@app.route("/")
@app.route("/")
def index():
	conn = mysql.connect()
	cursor = conn.cursor()
	id = request.args.get("id")
	cursor.execute(f"SELECT * FROM users_table WHERE id = {id}")
	result = cursor.fetchall()
	
	if "edit" in request.args:
		id = request.args.get("id")
		name = request.args.get("name_edit")
		email = request.args.get("email_edit")
		city = request.args.get("city_edit")
		age = request.args.get("age_edit")
		profession = request.args.get("profession_edit")
		phone = request.args.get("phone_edit")
		cursor.execute(f"UPDATE users_table SET name = '{name}', email = '{email}', city = '{city}', age = '{age}', profession = '{profession}', phone = '{phone}' WHERE id = {id}")
		conn.commit()
		return redirect(f"http://192.168.56.101:8080/")
		
		

	if "delete" in request.args:
		id = request.args.get("id")
		cursor.execute(f"DELETE FROM users_table WHERE id = {id}")
		conn.commit()
		return redirect(f"http://192.168.56.101:8080/")
	
	conn.close()
	cursor.close()
	return render_template('user.html', users = result)
		
			


	
	
	
if __name__ == "__main__":
	app.run(host='0.0.0.0')
