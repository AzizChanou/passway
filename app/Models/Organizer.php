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
     * Get all of the events for the Organizer
     *
     * @return 
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public static function getOrganizerEvents()
    {
        return self::with('events')
            ->with('comments')
            ->with('passes')
            ->with('eventCategory')
            ->with('eventCategory')
            ->withCount('comments')
            ->where('events.organizer_id', auth()->user()->organizer()->id)
            ->get();
    }
}
