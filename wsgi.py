"""
WSGI entry point for production servers (Gunicorn, uWSGI, etc.)
"""

import os
from dotenv import load_dotenv

# Load environment variables
load_dotenv()

# Import Flask app
from app import app

# Ensure static files are served correctly in production
app.config['STATIC_FOLDER'] = os.path.join(os.path.dirname(__file__), 'static')
app.config['STATIC_URL_PATH'] = '/static'

if __name__ == "__main__":
    app.run()
