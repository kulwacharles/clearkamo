<?php

namespace Database\Seeders;

use App\Models\CoreValue;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CoreValueSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('core_values')) {
            $this->command->warn('Skipping CoreValueSeeder: core_values table does not exist. Run php artisan migrate first.');
            return;
        }

        $values = [
            [
                'icon'       => 'fa-users',
                'title'      => 'Community/Customer-centred',
                'summary'    => 'We design and deliver solutions around the lived realities of the people and organizations we serve.',
                'sort_order' => 1,
                'status'     => 'published',
            ],
            [
                'icon'       => 'fa-earth-africa',
                'title'      => 'Local Relevance with Global Reach',
                'summary'    => 'We ground our work in local context while applying proven global standards and multidisciplinary expertise.',
                'sort_order' => 2,
                'status'     => 'published',
            ],
            [
                'icon'       => 'fa-chart-line',
                'title'      => 'Evidence-based Practice',
                'summary'    => 'We use data, diagnostics, and measurable signals to guide decisions and continuously improve outcomes.',
                'sort_order' => 3,
                'status'     => 'published',
            ],
            [
                'icon'       => 'fa-bullseye',
                'title'      => 'Accountable Results',
                'summary'    => 'We focus on clear commitments, transparent delivery, and measurable impact from strategy to execution.',
                'sort_order' => 4,
                'status'     => 'published',
            ],
            [
                'icon'       => 'fa-lightbulb',
                'title'      => 'Responsible Innovation',
                'summary'    => 'We innovate pragmatically, balancing speed and creativity with ethics, quality, and long-term sustainability.',
                'sort_order' => 5,
                'status'     => 'published',
            ],
        ];

        foreach ($values as $value) {
            CoreValue::firstOrCreate(['title' => $value['title']], $value);
        }
    }
}
