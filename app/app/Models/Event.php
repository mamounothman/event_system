<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TicketType;
use App\Models\BookingDiscount;

class Event extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'user_id',
        'description',
        // 'guests_counter',
        'capacity',
        'start_date',
        'end_date',
        'status'
    ];

    public function prices()
    {
        return $this->hasMany(TicketType::class);
    }

    public function discounts()
    {
        return $this->belongsToMany(BookingDiscount::class);
    }
}
