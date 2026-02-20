<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\AboutSection;
use App\Models\Service;
use Illuminate\Database\Seeder;

class PortfolioContentSeeder extends Seeder
{
    public function run(): void
    {
        // Hero Section
        HeroSection::updateOrCreate([], [
            'title' => 'AI & Data Science Trainer | Educator | Applied AI Practitioner',
            'subtitle' => 'Welcome to',
            'description' => 'I help students, professionals, and organizations build real-world skills in Data Science, Artificial Intelligence, and modern software technologies through structured training, practical projects, and industry-aligned learning.',
            'cta_text' => 'View Programs',
            'cta_link' => '/services',
            'cta2_text' => 'Explore Projects',
            'cta2_link' => '/projects',
            'is_active' => true,
        ]);

        // About Section
        AboutSection::updateOrCreate([], [
            'title' => 'About Me',
            'content' => "I am an AI and Data Science trainer dedicated to making advanced technology practical, accessible, and career-ready. My work revolves around teaching, building, and deploying data-driven solutions while mentoring learners from foundational to advanced levels.\n\nWith a strong focus on applied learning, I design programs that bridge the gap between theoretical knowledge and real-world implementation. My approach emphasizes hands-on projects, problem-solving, and industry-relevant tools so learners can confidently transition into professional roles.\n\nI actively work across:\n- Artificial Intelligence & Machine Learning training\n- Data Science and analytics education\n- Generative AI and modern AI tools\n- Real-world project mentoring\n- Curriculum and program design\n- Skill development for students and professionals\n\nMy mission is to empower learners to build meaningful technology, not just learn concepts.",
            'skills' => [
                'Data Science', 'Machine Learning', 'Artificial Intelligence', 'Generative AI',
                'Python', 'Data Analysis', 'Model Building', 'AI Tools & Frameworks',
                'Web-based AI Integration', 'Teaching & Mentoring', 'Project-based Learning',
                'Curriculum Design', 'Career Guidance'
            ],
            'is_active' => true,
        ]);

        // Services
        $services = [
            [
                'title' => 'AI & Data Science Training',
                'description' => 'Structured training programs covering fundamentals to advanced concepts with practical implementation.',
                'icon' => 'fas fa-brain',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Generative AI Enablement',
                'description' => 'Helping learners and teams adopt modern AI tools for productivity, automation, and innovation.',
                'icon' => 'fas fa-magic',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Real-World Project Mentoring',
                'description' => 'Guiding students through industry-style projects to build portfolios and problem-solving skills.',
                'icon' => 'fas fa-project-diagram',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Curriculum Design',
                'description' => 'Designing outcome-driven learning paths for schools, colleges, and professional learners.',
                'icon' => 'fas fa-book-open',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Career Guidance',
                'description' => 'Helping learners transition into roles in AI, Data Science, and tech through mentorship and roadmap planning.',
                'icon' => 'fas fa-compass',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['title' => $service['title']], $service);
        }

        echo "Portfolio content seeded successfully!\n";
    }
}
