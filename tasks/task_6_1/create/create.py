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
def index():
	conn = mysql.connect()
	cursor =conn.cursor()

	if "save" in request.args:
		name = request.args.get("name_create")
		email = request.args.get("email_create")
		city = request.args.get("city_create")
		age = request.args.get("age_create")
		profession = request.args.get("profession_create")
		phone = request.args.get("phone_create")
		cursor.execute(f"INSERT INTO users_table (name, email, city, age, profession, phone) VALUES ('{name}', '{email}', '{city}', '{age}', '{profession}', '{phone}')")
		conn.commit()
		return redirect(f"http://192.168.56.101:8080/")

	

	conn.close()
	cursor.close()
	return render_template("create.html")

if __name__ == "__main__":
	app.run(host='0.0.0.0')

