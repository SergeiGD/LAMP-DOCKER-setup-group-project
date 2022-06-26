from flask.cli import FlaskGroup

from project import app, db, User


cli = FlaskGroup(app)


@cli.command('create_db')
def create_db():
    db.drop_all()
    db.create_all()
    db.session.commit()


@cli.command('seed_db')
def seed_db():
    db.session.add(User(name='Ksenia', email='email1@mail.com', city='Irkutsk', age='30', profession='programmer', phone='89376547829'))
    db.session.add(User(name='Bob', email='email2@mail.com', city='Moscow', age='25', profession='accountant', phone='89763892567'))
    db.session.add(User(name='Anna', email='email3@mail.com', city='Irkutsk', age='25', profession='programmer', phone='89763892567'))
    db.session.add(User(name='Mark', email='email@mail.com', city='Moscow', age='40', profession='accountant', phone='89376547829'))
    db.session.add(User(name='Oliver', email='email@mail.com', city='Irkutsk', age='30', profession='programmer', phone='89027643678'))
    db.session.add(User(name='Harry', email='email4@mail.com', city='Moscow', age='40', profession='accountant', phone='89763892567'))
    db.session.add(User(name='Thomas', email='email5@mail.com', city='Irkutsk', age='50', profession='programmer', phone='89376547829'))
    db.session.commit()

if __name__ == '__main__':
    cli()
