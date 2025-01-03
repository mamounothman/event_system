<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\Booking;

class Booking extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'event_id',
        'user_id',
        'booking_date',
        'total_guests',
        'guest_name',
        'guest_email',
        'total_price',
        'prices',
        'status',
    ];

    protected $casts = [
        'prices' => 'array',
    ];

    public static function boot()
    {
        parent::boot();

        self::created(function($booking){
            $event = Event::find($booking->event->id);
            $total_guests = $booking->total_guests;
            $guests_counter = $event->guests_counter;
            $event->guests_counter += $total_guests;
            if($event->guests_counter === $event->capacity) {
                $event->status = 0;
            }
            $event->save();
            // $event->update(['guests_counter' => ( $guests_counter + $guests_counter)]);
        });
    }

    public function event()
    {
        return $this->belongsTo(Booking::class);
    }
}
