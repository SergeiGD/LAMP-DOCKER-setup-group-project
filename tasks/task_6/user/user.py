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
	cursor = conn.cursor()
	id = request.args.get("id")
	cursor.execute(f"SELECT * FROM users WHERE id = {id}")
	result = cursor.fetchall()
	
	if "edit" in request.args:
		id = request.args.get("id")
		name = request.args.get("name_edit")
		email = request.args.get("email_edit")
		city = request.args.get("city_edit")
		age = request.args.get("age_edit")
		profession = request.args.get("profession_edit")
		phone = request.args.get("phone_edit")
		cursor.execute(f"UPDATE users SET name = '{name}', email = '{email}', city = '{city}', age = '{age}', profession = '{profession}', phone = '{phone}' WHERE id = {id}")
		conn.commit()
		return redirect(f"http://192.168.56.101:80/")
		
		

	if "delete" in request.args:
		id = request.args.get("id")
		cursor.execute(f"DELETE FROM users WHERE id = {id}")
		conn.commit()
		redirect(f"http://192.168.56.101:80/")
	
	conn.close()
	cursor.close()
	return render_template('user.html', users = result)
		
			


#redirect(f"http://192.168.56.101:8080/")	

	
	
	
if __name__ == "__main__":
	app.run(host='0.0.0.0')
