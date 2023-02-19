<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Organizer;
use App\Models\Pass;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
                'organizer_id' => $organizer->id
            ])->each(function ($event) {
                Pass::factory()->create([
                    'event_id' => $event->id
                ]);
            });
        });
    }
}
