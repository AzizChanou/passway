<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function eventCategory()
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function passes()
    {
        return $this->hasMany(Pass::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function searchEvents($recherche)
    {
        return self::where('title', 'LIKE', '%' . $recherche . '%')
            ->orWhere('description', 'LIKE', '%' . $recherche . '%')
            ->with('eventCategory')
            ->withCount('comments')
            ->with('passes')
            ->with('comments')
            ->with('organizer')
            ->get();
    }

    public static function getEventDetails($id)
    {
        return self::with('eventCategory')
            ->withCount('comments')
            ->with('comments')
            ->with('passes')
            ->with('organizer')
            ->with('eventCategory')
            ->where('id', $id)
            ->where('date', '>=', now())
            ->first();
    }

    public static function getIncomingEvents($limit = null)
    {
        return self::where('date', '>=', now())
            ->with('organizer')
            ->with('eventCategory')
            ->with('passes')
            ->withCount('comments')
            ->limit($limit)
            ->get();
    }

    public static function updateEvent($event)
    {
        $eventToUpdate =  self::find($event->id);
        $eventToUpdate->name = $event->name;
        return redirect()->back()->with('success', 'Evnement mis a jour !');
    }
}
