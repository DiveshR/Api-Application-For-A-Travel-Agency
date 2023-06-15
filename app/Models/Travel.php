<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Travel extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = [
        'is_public',
        'slug',
        'name',
        'description',
        'number_of_days',
    ];

    protected $table = 'travels';


    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
    }


     public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getNumberOfNights(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => $attributes['number_of_days'] -1
        );
    }

}
