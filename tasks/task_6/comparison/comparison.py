from flask import Flask, render_template, request, redirect, abort
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

	checkNm = False
	checkEml = False
	checkCt = False
	checkAg = False
	checkProf = False
	checkPhn = False
	conn = get_db_connection()
	cursor =conn.cursor()
	
	id1 = request.args.get("id1")
	id2 = request.args.get("id2")
	
	cursor.execute(f"SELECT * FROM users WHERE id = {id1}")
	result1 = cursor.fetchall()
	
	cursor.execute(f"SELECT * FROM users WHERE id = {id2}")
	result2 = cursor.fetchall()
	
	if result1[0][0] == result2[0][0]:
		checkNm = True
	if result1[0][1] == result2[0][1]:	
		checkEml = True
	if result1[0][4] == result2[0][4]:
		checkCt = True
	if result1[0][5] == result2[0][5]:
		checkAg = True
	
	if result1[0][6] == result2[0][6]:
		checkProf = True
	if result1[0][7] == result2[0][7]:
		checkPhn = True		
				
	conn.close()
	cursor.close()
	return render_template('comparison.html', user1 = result1, user2 = result2, checkName = checkNm, checkEmail = checkEml, checkCity = checkCt, checkAge = checkAg, checkProfession = checkProf, checkPhone = checkPhn)
	
	


if __name__ == "__main__":
	app.run(host='0.0.0.0')
