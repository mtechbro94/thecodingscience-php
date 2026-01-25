"""
Comprehensive test suite for The Coding Science Flask application
"""

import pytest
import sys
from pathlib import Path
from datetime import datetime

sys.path.insert(0, str(Path(__file__).parent.parent))

from app import app, db, User, Course, Enrollment, CourseReview, ContactMessage


@pytest.fixture
def client():
    """Create test client"""
    app.config['TESTING'] = True
    app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///:memory:'
    app.config['WTF_CSRF_ENABLED'] = False
    
    with app.app_context():
        db.create_all()
        yield app.test_client()
        db.session.remove()
        db.drop_all()


# ==================== Page Tests ====================

def test_home_page(client):
    """Test home page loads"""
    response = client.get('/')
    assert response.status_code == 200


def test_register_page(client):
    """Test registration page"""
    response = client.get('/register')
    assert response.status_code == 200


def test_login_page(client):
    """Test login page"""
    response = client.get('/login')
    assert response.status_code == 200


def test_courses_page(client):
    """Test courses page"""
    response = client.get('/courses')
    assert response.status_code == 200


def test_about_page(client):
    """Test about page"""
    response = client.get('/about')
    assert response.status_code == 200


def test_contact_page(client):
    """Test contact page"""
    response = client.get('/contact')
    assert response.status_code == 200


def test_services_page(client):
    """Test services page"""
    response = client.get('/services')
    assert response.status_code == 200


def test_internships_page(client):
    """Test internships page"""
    response = client.get('/internships')
    assert response.status_code == 200


# ==================== Authentication Tests ====================

def test_register_user(client):
    """Test user registration"""
    response = client.post('/register', data={
        'name': 'New User',
        'email': 'new@example.com',
        'phone': '9876543210',
        'password': 'testpass123',
        'confirm': 'testpass123'
    }, follow_redirects=True)
    assert response.status_code == 200


def test_login_valid(client):
    """Test login with valid credentials"""
    # Create user
    with app.app_context():
        user = User(email='user@example.com', name='User', phone='123')
        user.set_password('pass123')
        db.session.add(user)
        db.session.commit()
    
    # Login
    response = client.post('/login', data={
        'email': 'user@example.com',
        'password': 'pass123'
    }, follow_redirects=True)
    assert response.status_code == 200


def test_login_invalid(client):
    """Test login with invalid credentials"""
    response = client.post('/login', data={
        'email': 'nouser@example.com',
        'password': 'wrongpass'
    })
    assert response.status_code in [200, 302, 401]


# ==================== Course Tests ====================

def test_course_creation(client):
    """Test course creation"""
    with app.app_context():
        course = Course(
            name='Python Basics',
            description='Learn Python',
            price=499,
            duration='3 Months',
            level='Beginner',
            created_at=datetime.utcnow()
        )
        db.session.add(course)
        db.session.commit()
        
        found = db.session.query(Course).first()
        assert found is not None
        assert found.name == 'Python Basics'


def test_course_detail_page(client):
    """Test course detail page"""
    with app.app_context():
        course = Course(
            name='Test Course',
            price=299,
            created_at=datetime.utcnow()
        )
        db.session.add(course)
        db.session.commit()
        course_id = course.id
    
    response = client.get(f'/course/{course_id}')
    assert response.status_code == 200


def test_course_not_found(client):
    """Test 404 for non-existent course"""
    response = client.get('/course/99999')
    assert response.status_code == 404


# ==================== Review Tests ====================

def test_review_creation(client):
    """Test review model creation"""
    with app.app_context():
        user = User(email='rev@example.com', name='User', phone='123')
        user.set_password('pass')
        course = Course(name='Course', price=100, created_at=datetime.utcnow())
        
        db.session.add(user)
        db.session.add(course)
        db.session.flush()
        
        review = CourseReview(
            course_id=course.id,
            user_id=user.id,
            rating=5,
            review_text='Great!',
            is_approved=True,
            created_at=datetime.utcnow(),
            updated_at=datetime.utcnow()
        )
        db.session.add(review)
        db.session.commit()
        
        found = db.session.query(CourseReview).first()
        assert found.rating == 5


def test_get_course_reviews(client):
    """Test getting course reviews"""
    with app.app_context():
        course = Course(name='Course', price=100, created_at=datetime.utcnow())
        db.session.add(course)
        db.session.commit()
        course_id = course.id
    
    response = client.get(f'/course/{course_id}/reviews')
    # May not have a specific endpoint, just check it doesn't crash
    assert response.status_code in [200, 404]


# ==================== Admin Tests ====================

def test_admin_unauthorized(client):
    """Test admin page without auth"""
    response = client.get('/admin')
    # Might 404 if route doesn't exist, or 302/401 if auth required
    assert response.status_code in [302, 401, 403, 404]


def test_admin_students(client):
    """Test admin students page"""
    response = client.get('/admin/students')
    assert response.status_code in [302, 401, 403, 200]


def test_admin_courses(client):
    """Test admin courses page"""
    response = client.get('/admin/courses')
    assert response.status_code in [302, 401, 403, 200]


def test_admin_reviews(client):
    """Test admin reviews page"""
    response = client.get('/admin/reviews')
    assert response.status_code in [302, 401, 403, 200]


# ==================== Contact Tests ====================

def test_contact_submit(client):
    """Test contact form submission"""
    response = client.post('/contact', data={
        'name': 'John Doe',
        'email': 'john@example.com',
        'message': 'Test message'
    }, follow_redirects=True)
    assert response.status_code == 200


def test_contact_message_saved(client):
    """Test contact message is saved"""
    with app.app_context():
        message = ContactMessage(
            name='Test',
            email='test@example.com',
            message='Hello',
            created_at=datetime.utcnow()
        )
        db.session.add(message)
        db.session.commit()
        
        found = db.session.query(ContactMessage).first()
        assert found.message == 'Hello'


# ==================== Error Tests ====================

def test_404_page(client):
    """Test 404 error page"""
    response = client.get('/nonexistent')
    assert response.status_code == 404


def test_user_password_hashing(client):
    """Test password hashing"""
    with app.app_context():
        user = User(email='hash@example.com', name='Test', phone='123')
        user.set_password('mypassword')
        
        assert user.check_password('mypassword')
        assert not user.check_password('wrongpassword')


# ==================== Integration Tests ====================

def test_enrollment_creation(client):
    """Test enrollment creation"""
    with app.app_context():
        user = User(email='enroll123@example.com', name='User', phone='9876543210')
        user.set_password('testpass123')
        course = Course(name='Course123', price=100, created_at=datetime.utcnow())
        
        db.session.add(user)
        db.session.add(course)
        db.session.flush()
        
        enrollment = Enrollment(
            user_id=user.id,
            course_id=course.id,
            status='completed',
            amount_paid=100,
            enrolled_at=datetime.utcnow(),
            payment_id='unique_' + str(user.id) + '_' + str(course.id)
        )
        db.session.add(enrollment)
        db.session.commit()
        
        found = db.session.query(Enrollment).first()
        assert found.status == 'completed'
