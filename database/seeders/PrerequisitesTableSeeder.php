<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrerequisitesTableSeeder extends Seeder
{
    public function run()
    {
        $now = now();

        DB::table('prerequisites')->insert([
            // ✅ Subjects
            ['id' => 166, 'prerequisite_name' => 'Computer Networks', 'prerequisite_type' => 'Subject', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 170, 'prerequisite_name' => 'Information Security', 'prerequisite_type' => 'Subject', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 171, 'prerequisite_name' => 'Cloud Computing', 'prerequisite_type' => 'Subject', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 172, 'prerequisite_name' => 'Database Systems', 'prerequisite_type' => 'Subject', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 173, 'prerequisite_name' => 'Cybersecurity Basics', 'prerequisite_type' => 'Subject', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 176, 'prerequisite_name' => 'Operating Systems', 'prerequisite_type' => 'Subject', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 197, 'prerequisite_name' => 'DevOps Fundamentals', 'prerequisite_type' => 'Subject', 'category_id' => 1, 'created_at' => $now, 'updated_at' => $now],

            // ✅ Technical Skills
            ['id' => 37, 'prerequisite_name' => 'Shell Scripting', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 38, 'prerequisite_name' => 'Monitoring Tools (e.g., Prometheus)', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 41, 'prerequisite_name' => 'Infrastructure as Code (Terraform)', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 43, 'prerequisite_name' => 'CI/CD Pipelines', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 44, 'prerequisite_name' => 'Docker & Containers', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 45, 'prerequisite_name' => 'Kubernetes Basics', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 47, 'prerequisite_name' => 'Linux Fundamentals', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 48, 'prerequisite_name' => 'Cloud Platforms (AWS, Azure)', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 77, 'prerequisite_name' => 'Security Tools (OWASP, Wireshark)', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 131, 'prerequisite_name' => 'Ansible Basics', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 141, 'prerequisite_name' => 'Jenkins for Automation', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 149, 'prerequisite_name' => 'Secrets Management', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 150, 'prerequisite_name' => 'Log Aggregation Tools', 'prerequisite_type' => 'Technical Skill', 'category_id' => 2, 'created_at' => $now, 'updated_at' => $now],

            // ✅ Non-Technical Skills
            ['id' => 74, 'prerequisite_name' => 'Problem Solving', 'prerequisite_type' => 'Non-Technical Skill', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 103, 'prerequisite_name' => 'Time Management', 'prerequisite_type' => 'Non-Technical Skill', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now],
            ['id' => 135, 'prerequisite_name' => 'Adaptability', 'prerequisite_type' => 'Non-Technical Skill', 'category_id' => 3, 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
