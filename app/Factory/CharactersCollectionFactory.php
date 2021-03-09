<?php


namespace App\Factory;


use App\Exceptions\IncorrectDataParameters;
use App\Support\CharacterCollection;

class CharactersCollectionFactory
{
    private $characterEntityFactory;

    /**
     * CharactersCollectionFactory constructor.
     * @param $characterHydrator
     */
    public function __construct(CharacterEntityFactory $characterHydrator)
    {
        $this->characterEntityFactory = $characterHydrator;
    }

    /**
     * @param array $characters
     * @return CharacterCollection
     * @throws IncorrectDataParameters
     */
    public function create(array $characters): CharacterCollection
    {
        $collection = new CharacterCollection();
        foreach ($characters as $character) {
            $collection->push($this->characterEntityFactory->create($character));
        }

        return $collection;
    }
}
