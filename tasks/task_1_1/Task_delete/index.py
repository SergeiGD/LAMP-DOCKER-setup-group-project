#del.py
from flask import Flask, render_template, request, redirect #import mysql & flask
import psycopg2

app = Flask(__name__)

def get_db_connection():
    conn = psycopg2.connect(host='localhost',
								port=5432,
                            database='egor',
                            user='postgres',
                            password='Rasmus1love')
    return conn

@app.route("/")
def index():
	conn = get_db_connection()		#cursor delcaration & connection
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
