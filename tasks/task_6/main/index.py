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

	limit = 2
	prev = False
	next = False
	conn = get_db_connection()
	cursor =conn.cursor()
	row = 0
	id1 = 0
	id2 = 0

	if "moreInformation" in request.args:
		id = request.args.get("id")
		return redirect(f"http://192.168.56.101:83/?id={id}")
	if "create" in request.args:
		return redirect(f"http://192.168.56.101:82/")
		
	cursor.execute(f"SELECT * FROM users ORDER BY id")
	result = cursor.fetchmany(size=2)
	cursor.execute(f"SELECT count(*) FROM users")
	row_count = cursor.fetchone()
	
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
		cursor.execute(f"SELECT * FROM users ORDER BY id  LIMIT {limit} OFFSET {row}")
		result = cursor.fetchall()
		
		
		
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
		
		cursor.execute(f"SELECT * FROM users ORDER BY id  LIMIT {limit} OFFSET {row}")
		result = cursor.fetchall()
	if "comparison" in request.args:
		id1 = request.args.get("id1")
		id2 = request.args.get("id2")	
		return redirect(f"http://192.168.56.101:81/?id1={id1}&id2={id2}")
			
	if row >= 2:
		prev = True	
	else:
		prev = False
		
	if row == int(row_count[0]) - 2 or row == int(row_count[0]) - 1:
		next = False
	else:
		next = True
		

	conn.close()
	cursor.close()
	return render_template('index.html', users = result, check_prev = prev, check_next = next, rowQuantity = row, id1Text = id1, id2Text = id2)
	
	


if __name__ == "__main__":
	app.run(host='0.0.0.0')
