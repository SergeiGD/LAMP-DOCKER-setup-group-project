from flask import Flask, render_template, request, redirect
from flask_sqlalchemy import SQLAlchemy


app = Flask(__name__)
app.config.from_object('project.config.Config')
db = SQLAlchemy(app)

class User(db.Model):
	__tablename__ = 'users'
	id = db.Column(db.Integer, primary_key=True)
	name = db.Column(db.String(128), unique=False, nullable=False)
	email = db.Column(db.String(128), unique=False, nullable=False)
	city = db.Column(db.String(128), unique=False, nullable=False)
	age = db.Column(db.Integer, unique=False, nullable=False)
	profession = db.Column(db.String(128), unique=False, nullable=False)
	phone = db.Column(db.String(128), unique=False, nullable=False)

	def __init__(self, name, email, city, age, profession, phone):
		self.name = name
		self.email = email
		self.city = city
		self.age = age
		self.profession = profession
		self.phone = phone
@app.route('/')
def comparison():

	checkNm = False
	checkEml = False
	checkCt = False
	checkAg = False
	checkProf = False
	checkPhn = False
	id1 = request.args.get("id1")
	id2 = request.args.get("id2")
	
	try:
		result1 = User.query.get(id1)
		result2 = User.query.get(id2)
		if result1.name == result2.name:
			checkNm = True
		if result1.email == result2.email:  
			checkEml = True
		if result1.city == result2.city:
			checkCt = True
		if result1.age == result2.age:
			checkAg = True
		if result1.profession == result2.profession:
			checkProf = True
		if result1.phone == result2.phone:
			checkPhn = True
		return render_template('comparison.html', user1 = result1, user2 = result2, checkName = checkNm, checkEmail = checkEml, checkCity = checkCt, checkAge = checkAg, checkProfession = checkProf, checkPhone = checkPhn)
	except:
    		return redirect(f"http://localhost:1337/")
