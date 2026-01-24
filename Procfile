web: python -c "from app import app, db; app.app_context().push(); db.create_all()" && gunicorn -w 4 -b 0.0.0.0:$PORT wsgi:app
