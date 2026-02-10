<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Admin user ──
        User::updateOrCreate(
            ['email' => 'admin@thecodingscience.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin@123'),
                'role' => 'admin',
                'is_active' => true,
                'is_approved' => true,
            ]
        );

        // ── Courses ──
        $courses = [
            ['name' => 'Full Stack Web Development', 'description' => 'Master front-end and back-end web development with HTML, CSS, JavaScript, React, Node.js, and databases. Build complete web applications from scratch.', 'summary' => 'Complete web development bootcamp from frontend to backend', 'duration' => '4 Months', 'price' => 1499, 'level' => 'Beginner', 'image' => 'fullstack.jpg', 'curriculum' => json_encode(['HTML5 & CSS3 Fundamentals', 'JavaScript ES6+ Deep Dive', 'React.js & Component Architecture', 'Node.js & Express Backend', 'MongoDB & Database Design', 'REST API Development', 'Authentication & Security', 'Deployment & DevOps Basics'])],
            ['name' => 'Data Science with Python', 'description' => 'Learn data analysis, visualization, statistics, and machine learning with Python. Work with real datasets and build predictive models.', 'summary' => 'Data analysis and ML with Python, Pandas, NumPy', 'duration' => '3 Months', 'price' => 1499, 'level' => 'Intermediate', 'image' => 'datascience.jpg', 'curriculum' => json_encode(['Python for Data Science', 'NumPy & Pandas Mastery', 'Data Visualization (Matplotlib, Seaborn)', 'Statistics & Probability', 'Scikit-learn ML Algorithms', 'Feature Engineering', 'Model Evaluation & Tuning', 'Capstone Project'])],
            ['name' => 'Machine Learning & AI', 'description' => 'Deep dive into machine learning algorithms, deep learning with TensorFlow/PyTorch, and practical AI applications.', 'summary' => 'Advanced ML, deep learning, and AI applications', 'duration' => '4 Months', 'price' => 1499, 'level' => 'Advanced', 'image' => 'ml-ai.jpg', 'curriculum' => json_encode(['Linear & Logistic Regression', 'Decision Trees & Random Forest', 'SVM & Ensemble Methods', 'Neural Networks Fundamentals', 'TensorFlow & Keras', 'CNNs for Computer Vision', 'RNNs & NLP Basics', 'Reinforcement Learning Intro'])],
            ['name' => 'Python Programming', 'description' => 'Learn Python from scratch — variables, data structures, OOP, file handling, modules, and build real projects.', 'summary' => 'Python from zero to hero with hands-on projects', 'duration' => '2 Months', 'price' => 499, 'level' => 'Beginner', 'image' => 'python.jpg', 'curriculum' => json_encode(['Python Basics & Setup', 'Variables & Data Types', 'Control Flow & Loops', 'Functions & Modules', 'Object-Oriented Programming', 'File Handling & Error Handling', 'Libraries Overview', 'Mini Projects'])],
            ['name' => 'DSA with Python', 'description' => 'Master data structures and algorithms in Python. Prepare for coding interviews with 200+ practice problems.', 'summary' => 'Data structures, algorithms, and interview prep', 'duration' => '3 Months', 'price' => 999, 'level' => 'Intermediate', 'image' => 'dsa.jpg', 'curriculum' => json_encode(['Arrays & Strings', 'Linked Lists', 'Stacks & Queues', 'Trees & Graphs', 'Sorting & Searching', 'Dynamic Programming', 'Greedy Algorithms', 'Interview Patterns & Practice'])],
            ['name' => 'Ethical Hacking & Cybersecurity', 'description' => 'Learn ethical hacking, penetration testing, network security, and cybersecurity fundamentals to protect systems.', 'summary' => 'Cybersecurity fundamentals and penetration testing', 'duration' => '3 Months', 'price' => 1499, 'level' => 'Intermediate', 'image' => 'hacking.jpg', 'curriculum' => json_encode(['Introduction to Cybersecurity', 'Networking Fundamentals', 'Linux for Hackers', 'Footprinting & Reconnaissance', 'Scanning & Enumeration', 'Web Application Security', 'Password Cracking', 'Social Engineering & Defense'])],
            ['name' => 'Computer Science Fundamentals', 'description' => 'Build a strong foundation in CS — computer architecture, operating systems, networking, databases, and software engineering.', 'summary' => 'Core CS concepts for aspiring engineers', 'duration' => '2 Months', 'price' => 499, 'level' => 'Beginner', 'image' => 'cs-fundamentals.jpg', 'curriculum' => json_encode(['Number Systems & Logic Gates', 'Computer Architecture', 'Operating Systems Concepts', 'Networking Basics', 'Database Management', 'Software Engineering', 'Version Control (Git)', 'Career Guidance'])],
            ['name' => 'Java Programming', 'description' => 'Learn Java programming language, OOP concepts, collections, multithreading, and build production-ready applications.', 'summary' => 'Core Java for software development', 'duration' => '3 Months', 'price' => 999, 'level' => 'Beginner', 'image' => 'java.jpg', 'curriculum' => json_encode(['Java Setup & Basics', 'OOP in Java', 'Collections Framework', 'Exception Handling', 'File I/O & Serialization', 'Multithreading', 'JDBC & Database', 'Spring Boot Introduction'])],
            ['name' => 'Cloud Computing & DevOps', 'description' => 'Master AWS, Docker, Kubernetes, CI/CD pipelines, and modern infrastructure management.', 'summary' => 'AWS, Docker, Kubernetes, and CI/CD pipelines', 'duration' => '3 Months', 'price' => 1499, 'level' => 'Advanced', 'image' => 'cloud.jpg', 'curriculum' => json_encode(['Cloud Computing Concepts', 'AWS Core Services (EC2, S3, RDS)', 'Docker & Containerization', 'Kubernetes Orchestration', 'CI/CD with GitHub Actions', 'Infrastructure as Code (Terraform)', 'Monitoring & Logging', 'Security Best Practices'])],
        ];

        foreach ($courses as $c) {
            Course::updateOrCreate(['name' => $c['name']], $c);
        }

        // ── Blog posts ──
        $blogs = [
            ['title' => 'Top 5 Programming Languages to Learn in 2026', 'slug' => 'top-5-programming-languages-2026', 'excerpt' => 'Discover the most in-demand programming languages that will shape your career in 2026 and beyond.', 'content' => '<p>The tech landscape is constantly evolving. Here are the top 5 programming languages you should learn in 2026:</p><h3>1. Python</h3><p>Python continues to dominate in AI, data science, and web development.</p><h3>2. JavaScript</h3><p>JavaScript remains essential for web development and is expanding into mobile and server-side.</p><h3>3. Rust</h3><p>Rust is gaining popularity for systems programming with memory safety.</p><h3>4. Go</h3><p>Go excels in cloud infrastructure and microservices.</p><h3>5. TypeScript</h3><p>TypeScript adds type safety to JavaScript, making it ideal for large applications.</p>', 'author' => 'The Coding Science', 'display_date' => 'Jan 15, 2026'],
            ['title' => 'How to Break Into Tech Without a CS Degree', 'slug' => 'break-into-tech-without-cs-degree', 'excerpt' => 'A practical guide for non-CS graduates who want to start a career in technology.', 'content' => '<p>You don\'t need a computer science degree to have a successful tech career. Here\'s how:</p><h3>Build Projects</h3><p>Employers care about what you can build. Create a portfolio of real projects.</p><h3>Learn Online</h3><p>Platforms like The Coding Science offer structured, industry-ready courses.</p><h3>Get Certified</h3><p>Industry certifications can validate your skills and open doors.</p><h3>Network</h3><p>Join tech communities, attend meetups, and connect on LinkedIn.</p>', 'author' => 'The Coding Science', 'display_date' => 'Feb 01, 2026'],
            ['title' => 'Understanding Machine Learning: A Beginner\'s Guide', 'slug' => 'understanding-machine-learning-beginners', 'excerpt' => 'An introduction to machine learning concepts, types, and real-world applications.', 'content' => '<p>Machine Learning is a subset of AI that enables computers to learn from data.</p><h3>Types of ML</h3><p><strong>Supervised Learning:</strong> Learning from labeled data (classification, regression).</p><p><strong>Unsupervised Learning:</strong> Finding patterns in unlabeled data (clustering, dimensionality reduction).</p><p><strong>Reinforcement Learning:</strong> Learning through trial and error with rewards.</p><h3>Real-World Applications</h3><p>ML powers recommendation engines, self-driving cars, fraud detection, and more.</p>', 'author' => 'The Coding Science', 'display_date' => 'Feb 05, 2026'],
        ];

        foreach ($blogs as $b) {
            Blog::updateOrCreate(['slug' => $b['slug']], $b);
        }
    }
}
