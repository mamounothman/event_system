<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Enum\DiscountType;

class BookingDiscount extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'event_id',
        'description',
        // 'type',
        'rule',
        'discount_amount',
        'invert'
    ];

    // protected $casts = [
    //     'type' => DiscountType::class
    // ];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
