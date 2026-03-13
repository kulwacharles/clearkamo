<?php

namespace Database\Seeders;

use App\Models\MaintenanceRoute;
use Illuminate\Database\Seeder;

class MaintenanceRoutesSeeder extends Seeder
{
    public function run(): void
    {
        $routes = [
            ['name' => 'Home Page',         'route_name' => 'home',                    'path' => '/'],
            ['name' => 'About Us',          'route_name' => 'about-us',                'path' => '/about-us'],
            ['name' => 'Contact Us',        'route_name' => 'contact-us',              'path' => '/contact-us'],
            ['name' => 'News & Updates',    'route_name' => 'news-and-update',         'path' => '/news-and-updates'],
            ['name' => 'Publications',      'route_name' => 'publications',            'path' => '/publications'],
            ['name' => 'Services',          'route_name' => 'services',                'path' => '/services'],
            ['name' => 'Projects',          'route_name' => 'projects',                'path' => '/projects'],
            ['name' => 'Vacancies',         'route_name' => 'vacancies',               'path' => '/vacancies'],
            ['name' => 'Service Details',   'route_name' => 'service.details',         'path' => '/service/details/{slug}'],
            ['name' => 'Project Details',   'route_name' => 'project',                 'path' => '/project-details/{slug}'],
            ['name' => 'Blog Details',      'route_name' => 'news-and-updates.details','path' => '/news-and-updates/details/{slug}'],
            ['name' => 'Publication Details','route_name' => 'publication.details',    'path' => '/publication/details/{slug}'],
            ['name' => 'Team Details',      'route_name' => 'team-details',            'path' => '/team-details/{slug}'],
            ['name' => 'Vacancy Details',   'route_name' => 'vacancy.details',         'path' => '/vacancy/details/{slug}'],
        ];

        foreach ($routes as $route) {
            MaintenanceRoute::firstOrCreate(
                ['route_name' => $route['route_name']],
                array_merge($route, ['is_active' => false, 'message' => null])
            );
        }
    }
}
