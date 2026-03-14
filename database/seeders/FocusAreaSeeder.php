<?php

namespace Database\Seeders;

use App\Models\FocusArea;
use Illuminate\Database\Seeder;

class FocusAreaSeeder extends Seeder
{
    public function run(): void
    {
        $areas = [
            [
                'icon'       => 'fa-tasks',
                'title'      => 'Execution Performance & Delivery Reliability',
                'summary'    => 'We support organizations to improve delivery consistency and reduce execution breakdowns.',
                'details'    => 'Our work focuses on practical routines, stronger coordination, and clear decision ownership for sustained implementation quality.',
                'sort_order' => 1,
                'status'     => 'published',
            ],
            [
                'icon'       => 'fa-brain',
                'title'      => 'Agency & Decision Environment Design',
                'summary'    => 'We improve follow-through by strengthening the environment in which decisions are made and acted on.',
                'details'    => 'This includes aligning incentives, clarifying accountability, and removing operational friction points across teams.',
                'sort_order' => 2,
                'status'     => 'published',
            ],
            [
                'icon'       => 'fa-lightbulb',
                'title'      => 'Think-Do Strategy Architecture',
                'summary'    => 'We connect planning and implementation so strategies remain actionable under real-world constraints.',
                'details'    => 'Our support combines strategy formulation with implementation enablement to protect outcomes during rollout.',
                'sort_order' => 3,
                'status'     => 'published',
            ],
            [
                'icon'       => 'fa-users-cog',
                'title'      => 'Behavioural & Choice Architecture',
                'summary'    => 'We apply behavioral insight to improve adoption, accountability, and sustained action.',
                'details'    => 'Interventions are tailored to local context so behavior shifts are realistic, scalable, and measurable.',
                'sort_order' => 4,
                'status'     => 'published',
            ],
            [
                'icon'       => 'fa-exclamation-triangle',
                'title'      => 'High-Execution-Risk Sectors',
                'summary'    => 'We work in sectors where complexity is high and performance pressure is increasing.',
                'details'    => 'Our experience includes public systems and multi-partner delivery settings that require disciplined execution.',
                'sort_order' => 5,
                'status'     => 'published',
            ],
            [
                'icon'       => 'fa-shield-alt',
                'title'      => 'Execution Risk Management',
                'summary'    => 'We help teams detect delivery risks early and adapt implementation before outcomes are affected.',
                'details'    => 'This creates stronger resilience, better resource use, and improved reliability of results over time.',
                'sort_order' => 6,
                'status'     => 'published',
            ],
        ];

        foreach ($areas as $area) {
            FocusArea::firstOrCreate(['title' => $area['title']], $area);
        }
    }
}
