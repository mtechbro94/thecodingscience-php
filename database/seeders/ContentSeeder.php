<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Internship;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        // ── Truncate existing data to ensure "only 9 courses" ──
        Course::truncate();
        Internship::truncate();

        // ── 9 Specified Courses ──
        $courses = [
            [
                'name' => 'Full Stack Development',
                'description' => 'Master both frontend and backend development. Build complete, scalable web applications using modern stacks like MERN or Laravel.',
                'summary' => 'Comprehensive bootcamp for modern web developers',
                'duration' => '4 Months',
                'price' => 1499,
                'level' => 'Beginner to Advanced',
                'image' => 'fullstack.svg',
                'curriculum' => json_encode(['Frontend (HTML, CSS, JS, React)', 'Backend (Node.js/PHP)', 'Database Management', 'API Development', 'Deployment'])
            ],
            [
                'name' => 'Programming with Python',
                'description' => 'Learn the most versatile programming language. From basic syntax to advanced automation and scripting.',
                'summary' => 'Core Python programming from absolute zero',
                'duration' => '2 Months',
                'price' => 999,
                'level' => 'Beginner',
                'image' => 'python.svg',
                'curriculum' => json_encode(['Python Syntax', 'Data Structures', 'OOP Concepts', 'File Handling', 'Automation Scripts'])
            ],
            [
                'name' => 'Data Science from Scratch',
                'description' => 'Unlock the power of data. Learn statistics, data cleaning, and visualization to drive business insights.',
                'summary' => 'Data analysis and visualization foundations',
                'duration' => '3 Months',
                'price' => 1499,
                'level' => 'Intermediate',
                'image' => 'datascience.svg',
                'curriculum' => json_encode(['Statistics & Probability', 'Pandas & NumPy', 'Data Visualization', 'Cleaning Real Datasets', 'Case Studies'])
            ],
            [
                'name' => 'Ethical Hacking and Penetration Testing',
                'description' => 'Think like a hacker to protect systems. Learn network security, vulnerability assessment, and digital forensics.',
                'summary' => 'Cybersecurity fundamentals and ethical hacking',
                'duration' => '3 Months',
                'price' => 1499,
                'level' => 'Intermediate',
                'image' => 'hacking.svg',
                'curriculum' => json_encode(['Networking Basics', 'Kali Linux', 'Vulnerability Scanning', 'Wireless Hacking', 'System Hardening'])
            ],
            [
                'name' => 'Crash Course in Computer Science',
                'description' => 'A fast-paced introduction to the world of computing. Hardwares, OS, binary, and how computers really work.',
                'summary' => 'The complete "under the hood" view of technology',
                'duration' => '1 Month',
                'price' => 499,
                'level' => 'Beginner',
                'image' => 'cs-fundamentals.svg',
                'curriculum' => json_encode(['Binary & Logic Gates', 'Computer Architecture', 'OS Concepts', 'Networking Layouts', 'Cloud Basics'])
            ],
            [
                'name' => 'Machine Learning and AI Foundations',
                'description' => 'Step into the future of AI. Build and train models using Scikit-Learn and understand the math behind AI.',
                'summary' => 'Introduction to predictive modeling and AI',
                'duration' => '3 Months',
                'price' => 999,
                'level' => 'Intermediate',
                'image' => 'ml-ai.svg',
                'curriculum' => json_encode(['Linear Regression', 'Classification Models', 'Neural Networks Intro', 'Natural Language Processing', 'Computer Vision Basics'])
            ],
            [
                'name' => 'Data Analytics and BI Tools',
                'description' => 'Master tools like Power BI, Tableau, and Excel to transform raw data into stunning dashboards and reports.',
                'summary' => 'Business Intelligence and dashboard mastery',
                'duration' => '2 Months',
                'price' => 1499,
                'level' => 'Intermediate',
                'image' => 'datascience.svg',
                'curriculum' => json_encode(['Advanced Excel', 'SQL for Analytics', 'Power BI Dashboards', 'Tableau Visualization', 'Storytelling with Data'])
            ],
            [
                'name' => 'Android App Development',
                'description' => 'Build native mobile apps for millions of users. Learn Kotlin/Java and the Android Studio ecosystem.',
                'summary' => 'Mobile application development from scratch',
                'duration' => '3 Months',
                'price' => 1499,
                'level' => 'Intermediate',
                'image' => 'java.svg',
                'curriculum' => json_encode(['UI/UX Design for Mobile', 'Activities & Fragments', 'REST API Integration', 'Firebase Backend', 'Publishing to Play Store'])
            ],
            [
                'name' => 'MS Office Automation and AI Tools',
                'description' => 'Supercharge your productivity. Learn how to use AI tools with Excel, Word, and PowerPoint to work 10x faster.',
                'summary' => 'Modern productivity workflows with AI',
                'duration' => '1 Month',
                'price' => 499,
                'level' => 'Beginner',
                'image' => 'cs-fundamentals.svg',
                'curriculum' => json_encode(['Excel Automation', 'AI Writing Assistants', 'Automated Presentations', 'Email Productivity', 'Task Management Tools'])
            ],
        ];

        foreach ($courses as $c) {
            Course::create($c);
        }

        // ── 3 Specified Internships ──
        $internships = [
            [
                'role' => 'Web Development Intern',
                'company' => 'School of Technology and AI Innovations',
                'duration' => '3 Months',
                'location' => 'Remote',
                'stipend' => 999,
                'description' => 'Gain real-world experience building responsive web applications. Work with React, Node.js, and modern CSS frameworks under expert guidance.',
                'image' => 'fullstack.svg'
            ],
            [
                'role' => 'Python Development Intern',
                'company' => 'School of Technology and AI Innovations',
                'duration' => '3 Months',
                'location' => 'Remote',
                'stipend' => 999,
                'description' => 'Work on backend systems and automation scripts. Master Python libraries, API design, and database integration in a production environment.',
                'image' => 'python.svg'
            ],
            [
                'role' => 'Data Science and AI Intern',
                'company' => 'School of Technology and AI Innovations',
                'duration' => '3 Months',
                'location' => 'Remote',
                'stipend' => 999,
                'description' => 'Analyze real datasets and build predictive models. Learn to apply machine learning algorithms to solve business problems and gain AI insights.',
                'image' => 'datascience.svg'
            ],
        ];

        foreach ($internships as $i) {
            Internship::create($i);
        }
    }
}
