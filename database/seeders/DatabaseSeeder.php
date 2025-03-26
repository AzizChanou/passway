<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Organizer;
use App\Models\Pass;
use App\Models\Ticket;
use App\Models\User;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Organizer::factory()->create([
            'name' => 'Passway',
            'email' => 'kyogre@yopmail.fr',
            'phone' => '69457894',
            'address' => 'St. Rita',
        ])->each(function ($organizer) {
            User::factory()->create([
                'name' => 'Kyogre',
                'email' => 'kyogre@yopmail.fr',
                'role' => 'root',
                'organizer_id' => $organizer->id
            ]);
        });

        EventCategory::factory()->create([
            'name' => 'Conférence',
            'picture_path' => asset('storage/category/conference.png'),
            'description' => 'Des événements professionnels centrés sur l\'échange d\'informations et de connaissances dans un domaine particulier.',
        ]);

        EventCategory::factory()->create([
            'name' => 'Concert',
            'picture_path' => asset('storage/category/concert.png'),
            'description' => 'Des événements musicaux ou culturels qui peuvent durer plusieurs jours et attirer des milliers de personnes.',
        ]);

        EventCategory::factory()->create([
            'name' => 'Sport',
            'picture_path' => asset('storage/category/sport.png'),
            'description' => 'Des compétitions sportives de toutes sortes, des marathons aux tournois de golf en passant par les matchs de football ou de basket-ball.',
        ]);

        EventCategory::factory()->create([
            'name' => 'Communautaires',
            'picture_path' => asset('storage/category/community.png'),
            'description' => 'Des événements locaux et régionaux visant à rassembler les membres d\'une communauté autour d\'un intérêt commun, comme des festivals de rue, des foires, des expositions ou des marchés fermiers.',
        ]);

        EventCategory::factory()->create([
            'name' => 'Culturels',
            'picture_path' => asset('storage/category/cultural.png'),
            'description' => 'Ils incluent des festivals de musique, de cinéma ou d\'art, des expositions, des spectacles de danse ou de théâtre, des événements littéraires, des salons de livres, etc.',
        ]);

        Organizer::factory(1)->create()->each(function ($organizer) {
            User::factory(1)->create([
                'role' => 'admin',
                'organizer_id' => $organizer->id
            ]);
            Event::factory(1)->create([
                'title' => 'La nuit du Ramadan',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, eum.',
                'organizer_id' => $organizer->id,
                'event_category_id' => rand(1, EventCategory::all()->count())
            ])->each(function ($event) {
                Pass::factory(1)->create([
                    'event_id' => $event->id
                ]);

                Ticket::factory(400)->create([
                    'event_id' => $event->id,
                ])->each(function ($ticket) {

                    $writer = new PngWriter();
                    $i = 1;

                    $logo = Logo::create(public_path('assets/img/logo_dark.png'))
                        ->setResizeToWidth(100);

                    $qr_code = QrCode::create($ticket->code)
                        ->setEncoding(new Encoding('UTF-8'))
                        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                        ->setSize(400)
                        ->setMargin(10)
                        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                        ->setForegroundColor(new Color(0, 0, 0))
                        ->setBackgroundColor(new Color(255, 255, 255));

                    $image_content = $writer->write($qr_code, $logo);

                    Storage::put('public/qrcodes/' . Str::random(4) . '_' . $i . '.png', $image_content->getString());
                });
            });
        });
    }
}
