# 🎓 The Coding Science - Complete Setup & Deployment Guide

## 📖 Table of Contents
1. [Quick Start](#quick-start)
2. [Local Development](#local-development)
3. [Testing](#testing)
4. [GitHub Setup](#github-setup)
5. [Deployment](#deployment)
6. [Monitoring](#monitoring)

---

## 🚀 Quick Start

### Prerequisites
- Python 3.9+
- Git
- GitHub account
- Railway or Render account (for hosting)

### Clone & Setup (2 minutes)
```bash
# Clone repository
git clone https://github.com/your-username/TheCodingScience.git
cd TheCodingScience

# Create virtual environment
python -m venv .venv
source .venv/bin/activate  # On Windows: .venv\Scripts\activate

# Install dependencies
pip install -r requirements.txt

# Setup environment
cp .env.example .env
# Edit .env with your values

# Initialize database
python -c "from app import db, app; app.app_context().push(); db.create_all()"

# Run application
python app.py
```

Visit: **http://localhost:5000**

---

## 💻 Local Development

### Start the App
```bash
# Activate virtual environment
source .venv/bin/activate  # Windows: .venv\Scripts\activate

# Run Flask app
python app.py

# Or use Flask CLI
export FLASK_APP=app.py
flask run
```

### Create Admin User
```bash
python -c "
from app import db, app, User
app.app_context().push()
admin = User(email='admin@example.com', name='Admin', phone='1234567890', is_admin=True)
admin.set_password('admin123')
db.session.add(admin)
db.session.commit()
print('Admin created!')
"
```

### View Database
```bash
# Install SQLite browser or use CLI
sqlite3 instance/coding_science.db
.tables
SELECT * FROM users;
```

---

## ✅ Testing

### Run All Tests
```bash
pip install pytest pytest-cov
pytest tests/ -v
```

### Run Specific Tests
```bash
pytest tests/test_app.py::test_home_page -v
pytest tests/test_app.py::test_admin_panel_authorized -v
```

### Check Code Quality
```bash
pip install flake8
flake8 app.py

pip install pylint
pylint app.py
```

### Coverage Report
```bash
pytest --cov=. --cov-report=html
# Open htmlcov/index.html in browser
```

---

## 🐙 GitHub Setup

### 1. Create Repository
```bash
git init
git add .
git commit -m "Initial: The Coding Science Flask App"
git branch -M main

# Add to GitHub
git remote add origin https://github.com/YOUR_USERNAME/TheCodingScience.git
git push -u origin main
```

### 2. Add GitHub Secrets
1. Go to **Settings** → **Secrets and variables** → **Actions**
2. Create new secrets:

| Secret Name | Value | How to Get |
|---|---|---|
| `RAILWAY_TOKEN` | Your Railway API token | Railway → Account → API Tokens |
| `SECRET_KEY` | Random 32+ char string | `python -c "import secrets; print(secrets.token_urlsafe(32))"` |

### 3. Verify CI/CD Workflow
```bash
# Check workflow file exists
ls -la .github/workflows/ci-cd.yml

# It should automatically trigger on push
git push origin main
# Visit: GitHub repo → Actions tab
```

---

## 🚀 Deployment

### Option 1: Deploy on Railway (Recommended)

**Step 1: Create Railway Account**
- Visit https://railway.app
- Sign up with GitHub
- Create a new project

**Step 2: Get Railway Token**
- Account → API Tokens → Generate Token
- Copy token

**Step 3: Add to GitHub Secrets**
- GitHub repo → Settings → Secrets
- Add secret `RAILWAY_TOKEN`

**Step 4: Push to Deploy**
```bash
git push origin main
# Automatic deployment starts!
# Check GitHub Actions → Latest run
```

**View Deployment Logs**
```bash
npm install -g @railway/cli
railway login
railway logs -f
```

### Option 2: Manual Railway Deploy
```bash
npm install -g @railway/cli
railway login
railway link
railway up
```

---

## 📊 Monitoring

### Check GitHub Actions
1. Go to your GitHub repo
2. Click **Actions** tab
3. View recent workflow runs
4. Check logs for any failures

### Check Railway Deployment
1. Visit https://railway.app
2. Select your project
3. View logs in real-time
4. Monitor CPU, memory, disk usage

### Application Health Check
```bash
curl https://your-deployed-app.railway.app/
# Should return HTTP 200
```

---

## 🐛 Troubleshooting

### Error: "ModuleNotFoundError: No module named 'app'"
```bash
# Solution: Ensure pip install ran successfully
pip install -r requirements.txt
python app.py
```

### Error: "Database is locked"
```bash
# Solution: Remove old database and restart
rm instance/coding_science.db
python -c "from app import db, app; app.app_context().push(); db.create_all()"
python app.py
```

### Error: "No such table: users"
```bash
# Solution: Initialize database
python -c "from app import db, app; app.app_context().push(); db.create_all()"
```

### Error: "SECRET_KEY is undefined"
```bash
# Solution: Create .env file
cp .env.example .env
# Edit .env and add SECRET_KEY
python app.py
```

### Deployment Fails on GitHub Actions
1. Check GitHub Actions logs
2. Check if all environment variables are set
3. Ensure `requirements.txt` has all dependencies
4. Run `pytest` locally to verify

---

## 📋 Features Checklist

### ✅ Core Features
- [x] User Authentication (Register, Login, Logout)
- [x] Course Management & Display
- [x] Course Enrollment with Payment (UPI)
- [x] Course Reviews & Ratings
- [x] Admin Panel (Manage Users, Courses, Reviews)
- [x] Contact Form
- [x] Internship Applications
- [x] Email Notifications

### ✅ Technical Features
- [x] SQLAlchemy ORM with SQLite
- [x] Password Hashing (Werkzeug)
- [x] Session Management (Flask-Login)
- [x] CSRF Protection (Flask-WTF)
- [x] Responsive Design (Bootstrap 5)
- [x] Static File Serving (WhiteNoise)
- [x] Logging System
- [x] Error Handling

### ✅ DevOps & Deployment
- [x] GitHub Actions CI/CD
- [x] Automated Testing (Pytest)
- [x] Security Scanning (Bandit, Safety)
- [x] Code Quality Checks (Flake8)
- [x] Automatic Railway Deployment
- [x] Environment Variables Management
- [x] Database Initialization

---

## 🎯 Next Steps

1. **Deploy on Railway**
   - Get token → Add to GitHub Secrets → Push to main

2. **Configure Custom Domain**
   - Railway → Project → Settings → Domains

3. **Set Up Email Notifications**
   - Update `SENDER_EMAIL` and `SENDER_PASSWORD` in .env

4. **Monitor and Maintain**
   - Check GitHub Actions regularly
   - Monitor Railway logs
   - Update dependencies monthly

---

## 📚 Resources

- **Flask Documentation:** https://flask.palletsprojects.com
- **SQLAlchemy Documentation:** https://docs.sqlalchemy.org
- **Railway Documentation:** https://docs.railway.app
- **GitHub Actions:** https://docs.github.com/en/actions
- **Python Pytest:** https://pytest.org

---

## 🎉 You're All Set!

Your application is now configured for production deployment with automatic CI/CD! 

**Every push to main branch will:**
1. ✅ Run all tests
2. ✅ Check code quality
3. ✅ Scan for security issues
4. ✅ Deploy automatically to Railway

**Questions?** Check the [DEPLOYMENT.md](DEPLOYMENT.md) guide for detailed instructions.

---

**Happy Coding! 🚀**

*The Coding Science - Learn Technology, Transform Your Future*
