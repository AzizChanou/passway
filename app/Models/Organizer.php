<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get all of the users for the Organizer
     *
     * @return 
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get all of the events for the Organizer
     *
     * @return 
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public static function getOrganizerEvents($id)
    {
        if (auth()->user()->role === 'root') {
            return Event::with('organizer')
                ->with('comments')
                ->with('passes')
                ->with('eventCategory')
                ->withCount('comments', 'passes')
                ->get();
        } else {
            return Event::with('organizer')
                ->with('comments')
                ->with('passes')
                ->with('eventCategory')
                ->withCount('comments', 'passes')
                ->where('events.organizer_id', $id)
                ->get();
        }
    }
}
