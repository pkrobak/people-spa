<?php


namespace App\Entities\API;


use Illuminate\Support\Collection;

class CharacterResponseEntity
{
    /**
     * @var Collection
     */
    private $characters;

    /**
     * @var Collection
     */
    private $titles;

    /**
     * CharacterResponseEntity constructor.
     * @param Collection $characters
     * @param Collection $titles
     */
    public function __construct(Collection $characters, Collection $titles)
    {
        $this->characters = $characters;
        $this->titles = $titles;
    }

    /**
     * @return Collection
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    /**
     * @return Collection
     */
    public function getTitles(): Collection
    {
        return $this->titles;
    }

}
