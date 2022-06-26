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

	checkNm = False
	checkEml = False
	checkCt = False
	checkAg = False
	checkProf = False
	checkPhn = False
	conn = mysql.connect()
	cursor =conn.cursor()
	
	id1 = request.args.get("id1")
	id2 = request.args.get("id2")
		
		
	try:
		cursor.execute(f"SELECT * FROM users_table WHERE id = {id1}")
		result1 = cursor.fetchall()
	
		cursor.execute(f"SELECT * FROM users_table WHERE id = {id2}")
		result2 = cursor.fetchall()
		if result1[0][1] == result2[0][1]:
			checkNm = True
		if result1[0][2] == result2[0][2]:	
			checkEml = True
		if result1[0][3] == result2[0][3]:
			checkCt = True
		if result1[0][4] == result2[0][4]:
			checkAg = True
	
		if result1[0][5] == result2[0][5]:
			checkProf = True
		if result1[0][6] == result2[0][6]:
			checkPhn = True		
				
		conn.close()
		cursor.close()
		return render_template('comparison.html', user1 = result1, user2 = result2, checkName = checkNm, checkEmail = checkEml, checkCity = checkCt, checkAge = checkAg, checkProfession = checkProf, checkPhone = checkPhn)
	except:
		return redirect(f"http://192.168.56.101:8080/")
	
	
	
	


if __name__ == "__main__":
	app.run(host='0.0.0.0')
