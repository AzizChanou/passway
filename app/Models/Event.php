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
            ->with(['eventCategory', 'passes', 'comments', 'organizer'])
            ->withCount('comments')
            ->get();
    }

    public static function getEventDetails($id)
    {
        return self::findorfail($id)
            ->with(['organizer', 'eventCategory', 'comments', 'passes', 'eventCategory'])
            ->withCount('comments');
    }

    public static function getIncomingEvents($limit = null)
    {
        return self::where('date', '>=', now())
            ->with(['organizer', 'eventCategory', 'passes'])
            ->withCount('comments')
            ->limit($limit)
            ->get();
    }

    public static function updateEvent($event)
    {
        $eventToUpdate =  self::find($event->id);
        $eventToUpdate->name = $event->name;
        return redirect()->back()->with('success', 'Evenement mis a jour !');
    }
}
