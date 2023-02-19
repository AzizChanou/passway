<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Event;
use App\Models\Organizer;
use App\Models\Pass;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Kyogre',
            'email' => 'kyogre@yopmail.fr',
            'is_admin' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);


        \App\Models\EventCategory::factory()->create([
            'name' => 'Conférence',
            'picture_path' => asset('storage/category/conference.png'),
            'description' => 'Des événements professionnels centrés sur l\'échange d\'informations et de connaissances dans un domaine particulier.',
        ]);

        \App\Models\EventCategory::factory()->create([
            'name' => 'Concert',
            'picture_path' => asset('storage/category/concert.png'),
            'description' => 'Des événements musicaux ou culturels qui peuvent durer plusieurs jours et attirer des milliers de personnes.',
        ]);

        \App\Models\EventCategory::factory()->create([
            'name' => 'Sport',
            'picture_path' => asset('storage/category/sport.png'),
            'description' => 'Des compétitions sportives de toutes sortes, des marathons aux tournois de golf en passant par les matchs de football ou de basket-ball.',
        ]);

        \App\Models\EventCategory::factory()->create([
            'name' => 'Communautaires',
            'picture_path' => asset('storage/category/community.png'),
            'description' => 'Des événements locaux et régionaux visant à rassembler les membres d\'une communauté autour d\'un intérêt commun, comme des festivals de rue, des foires, des expositions ou des marchés fermiers.',
        ]);

        \App\Models\EventCategory::factory()->create([
            'name' => 'Culturels',
            'picture_path' => asset('storage/category/cultural.png'),
            'description' => 'Ils incluent des festivals de musique, de cinéma ou d\'art, des expositions, des spectacles de danse ou de théâtre, des événements littéraires, des salons de livres, etc.',
        ]);


        Organizer::factory(5)->create()->each(function ($organizer) {
            User::factory()->create([
                'is_admin' => 1,
                'organizer_id' => $organizer->id
            ]);
            User::factory(2)->create([
                'is_admin' => 0,
                'organizer_id' => $organizer->id
            ]);
            Event::factory(3)->create([
                'organizer_id' => $organizer->id,
                'event_categorie_id' => fake()->random_int(0, 5)
            ])->each(function ($event) {
                Pass::factory()->create([
                    'event_id' => $event->id
                ]);
                Comment::factory(10)->create([
                    'email' => fake()->email(),
                    'text' => fake()->text(100),
                    'event_id' => $event->id
                ]);
            });
        });
    }
}
