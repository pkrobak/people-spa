<?php

namespace App\Models;

use App\Support\CharacterCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{

    const GENDERS = [self::MALE, self::FEMALE];

    const MALE = 'Male';
    const FEMALE = 'Female';

    use HasFactory;

    protected $fillable = [
        'url',
        'name',
        'gender',
        'culture',
        'born',
        'died',
        'aliases',
        'father',
        'mother',
        'spouse',
        'allegiances',
        'books',
        'povBooks',
        'tvSeries',
        'playedBy',
    ];

    /**
     * @return BelongsToMany
     */
    public function titles(): BelongsToMany
    {
        return $this->belongsToMany(Title::class);
    }

    /**
     * @param array $models
     * @return CharacterCollection
     */
    public function newCollection(array $models = []): CharacterCollection
    {
        return new CharacterCollection($models);
    }
}
