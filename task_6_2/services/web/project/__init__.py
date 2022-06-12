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

def users():
	prev = False
	next = True
	id1 = 0
	id2 = 0
	row = 0
	limit = 2
	
	
	if "forward" in request.args:
		if 'id1' in request.args:
			id1 = int(request.args.get('id1'))
			if id1 is None:
				id1 = 0
		if 'id2' in request.args:
			id2 = int(request.args.get('id2'))
			if id2 is None:
				id2 = 0
		if 'rowQuantity' in request.args:
			row = int(request.args.get('rowQuantity'))
		row += 2
		users = User.query.limit(limit).offset(row).all()
		
		
		
	if "back" in request.args:
		if 'id1' in request.args:
			id1 = int(request.args.get('id1'))
			if id1 is None:
				id1 = 0
		if 'id2' in request.args:
			id2 = int(request.args.get('id2'))
			if id2 is None:
				id2 = 0
		if 'rowQuantity' in request.args:
			row = int(request.args.get('rowQuantity'))
		row -= 2
		
		users = User.query.limit(limit).offset(row).all()	
	
	if row >= 2:
		prev = True	
	else:
		prev = False
	if row == int(User.query.count()) - 2 or int(row == User.query.count()) - 1:
		next = False
	if row < int(User.query.count()) - 2:
		next = True
	if "comparison" in request.args:
		
		id1 = request.args.get("id1")
		id2 = request.args.get("id2")	
		
		return redirect(f"http://localhost:1338/?id1={id1}&id2={id2}")
	users = User.query.limit(limit).offset(row).all()
	return render_template('users.html', users=users, check_prev = prev, check_next = next, rowQuantity = row, id1Text = id1, id2Text = id2 )
