<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MemberCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Corporate Service',
            'Building, Construction & Property',
            'Food & Beverage',
            'Marketing & Event',
            'Trading, Retail & Wholesale',
            'Financial Services',
            'Beauty & Hobbies',
            'Warehouse & Logistic',
        ];

        foreach ($categories as $category) {
            \App\Models\MemberCategory::factory()->create([
                'name' => $category,
                'description' => '',
            ]);
        }
    }
}
