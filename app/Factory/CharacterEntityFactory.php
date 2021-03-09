<?php


namespace App\Factory;


use App\Entities\CharacterEntity;
use App\Exceptions\IncorrectDataParameters;

class CharacterEntityFactory
{
    /**
     * @param array $response
     * @return CharacterEntity
     * @throws IncorrectDataParameters
     */
    public function create(array $response): CharacterEntity
    {
        try {
            return new CharacterEntity(
                $response['url'],
                $response['name'],
                $response['gender'],
                $response['culture'],
                $response['born'],
                $response['died'],
                $response['titles'],
            );
        } catch (\Throwable $exception) {
            throw new IncorrectDataParameters('Invalid character parameters types');
        }
    }
}
