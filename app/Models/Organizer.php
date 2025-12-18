<?php

namespace App\Models;
use App\Observers\OrganizerObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[ObservedBy(OrganizerObserver::class)]
class Organizer extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'email', 'phone'];

    public function events() : HasMany {
        return $this->hasMany(Event::class);
    }
}
