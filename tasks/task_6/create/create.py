from flask import Flask, render_template, request, redirect
import psycopg2

app = Flask(__name__)

def get_db_connection():
    conn = psycopg2.connect(host='localhost',
			     port=8082,
                            database='ksenia',
                            user='ksenia',
                            password='passwd')
    return conn



@app.route("/")
def index():
	conn = get_db_connection()
	cursor =conn.cursor()

	if "save" in request.args:
		name = request.args.get("name_create")
		email = request.args.get("email_create")
		city = request.args.get("city_create")
		age = request.args.get("age_create")
		profession = request.args.get("profession_create")
		phone = request.args.get("phone_create")
		cursor.execute(f"INSERT INTO users (name, email, city, age, profession, phone) VALUES ('{name}', '{email}', '{city}', '{age}', '{profession}', '{phone}')")
		conn.commit()
		return redirect(f"http://192.168.56.101:80/")

	

	conn.close()
	cursor.close()
	return render_template("create.html")

if __name__ == "__main__":
	app.run(host='0.0.0.0')
