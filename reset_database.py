#!/usr/bin/env python
"""
Database Reset Script - Use this to reset the Railway database
Run: python reset_database.py
"""

from app import app, db, Course, User
import os
import sys

def reset_database():
    """Reset database with all courses"""
    with app.app_context():
        print("=" * 60)
        print("DATABASE RESET SCRIPT")
        print("=" * 60)
        
        # Confirm deletion
        response = input("\n⚠️  This will DELETE all data and reset the database.\nType 'YES' to continue: ")
        if response.upper() != 'YES':
            print("❌ Reset cancelled.")
            return
        
        print("\n🔄 Resetting database...")
        
        # Delete all tables
        db.drop_all()
        print("✓ Dropped all tables")
        
        # Create all tables
        db.create_all()
        print("✓ Created all tables")
        
        # Seed courses
        from app import seed_courses, init_db_on_startup
        seed_courses()
        print("✓ Seeded 6 courses with images")
        
        # Create default admin if needed
        admin_email = os.getenv('ADMIN_EMAIL', 'admin@thecodingscience.com')
        admin_password = os.getenv('ADMIN_PASSWORD', 'admin123')
        
        if not User.query.filter_by(is_admin=True).first():
            admin = User(
                name='Admin',
                email=admin_email,
                is_admin=True,
                is_active=True
            )
            admin.set_password(admin_password)
            db.session.add(admin)
            db.session.commit()
            print(f"✓ Created admin user: {admin_email}")
        else:
            print("ℹ️  Admin user already exists")
        
        # Verify
        courses = Course.query.all()
        print(f"\n✅ Database reset complete!")
        print(f"   - Courses: {len(courses)}")
        
        for course in courses:
            print(f"     • {course.name} ({course.image})")
        
        print("\n" + "=" * 60)
        print("Ready to use!")
        print("=" * 60)

if __name__ == '__main__':
    try:
        reset_database()
    except Exception as e:
        print(f"\n❌ Error: {e}")
        sys.exit(1)
