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

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function getEventDetails($id)
    {
        return self::with('eventCategory')
            ->withCount('tickets', 'comments')
            ->with('organizer:id')
            ->where('id', $id)
            ->where('date', '>=', now())
            ->first();
    }

    public static function newEvent()
    {
        return self::where('date', '>', now())
            ->with('organizer')
            ->with('eventCategory')
            ->withCount('tickets', 'comments')
            ->get();
    }
}
