<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Information Technology',
                'description' => 'Jobs related to software development, IT support, and technology services',
                'icon' => 'fas fa-laptop-code',
                'is_active' => true,
            ],
            [
                'name' => 'Healthcare',
                'description' => 'Medical, nursing, and healthcare service positions',
                'icon' => 'fas fa-heartbeat',
                'is_active' => true,
            ],
            [
                'name' => 'Finance',
                'description' => 'Banking, accounting, and financial service roles',
                'icon' => 'fas fa-chart-line',
                'is_active' => true,
            ],
            [
                'name' => 'Education',
                'description' => 'Teaching, training, and educational administration positions',
                'icon' => 'fas fa-graduation-cap',
                'is_active' => true,
            ],
            [
                'name' => 'Marketing',
                'description' => 'Digital marketing, advertising, and public relations roles',
                'icon' => 'fas fa-bullhorn',
                'is_active' => true,
            ],
            [
                'name' => 'Sales',
                'description' => 'Sales representative, account manager, and business development positions',
                'icon' => 'fas fa-handshake',
                'is_active' => true,
            ],
            [
                'name' => 'Customer Service',
                'description' => 'Customer support, call center, and service representative roles',
                'icon' => 'fas fa-headset',
                'is_active' => true,
            ],
            [
                'name' => 'Engineering',
                'description' => 'Civil, mechanical, electrical, and other engineering positions',
                'icon' => 'fas fa-cogs',
                'is_active' => true,
            ],
            [
                'name' => 'Human Resources',
                'description' => 'HR management, recruitment, and personnel administration roles',
                'icon' => 'fas fa-users',
                'is_active' => true,
            ],
            [
                'name' => 'Design',
                'description' => 'Graphic design, UI/UX, and creative design positions',
                'icon' => 'fas fa-palette',
                'is_active' => true,
            ],
            [
                'name' => 'Administrative',
                'description' => 'Office administration, executive assistant, and clerical roles',
                'icon' => 'fas fa-file-alt',
                'is_active' => true,
            ],
            [
                'name' => 'Legal',
                'description' => 'Lawyer, paralegal, and legal support positions',
                'icon' => 'fas fa-gavel',
                'is_active' => true,
            ],
            [
                'name' => 'Manufacturing',
                'description' => 'Production, quality control, and manufacturing operations roles',
                'icon' => 'fas fa-industry',
                'is_active' => true,
            ],
            [
                'name' => 'Retail',
                'description' => 'Store management, sales associate, and retail operations positions',
                'icon' => 'fas fa-shopping-bag',
                'is_active' => true,
            ],
            [
                'name' => 'Hospitality',
                'description' => 'Hotel, restaurant, and tourism service roles',
                'icon' => 'fas fa-utensils',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            $slug = Str::slug($category['name']);
            Category::updateOrCreate(
                ['slug' => $slug],
                array_merge($category, ['slug' => $slug])
            );
        }
    }
}
