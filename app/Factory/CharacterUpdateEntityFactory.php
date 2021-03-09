<?php


namespace App\Factory;


use App\Entities\Character\CharacterUpdateEntity;
use App\Http\Requests\Character\CharacterUpdateRequest;

class CharacterUpdateEntityFactory
{
    /**
     * @param CharacterUpdateRequest $request
     * @return CharacterUpdateEntity
     */
    public function create(CharacterUpdateRequest $request): CharacterUpdateEntity
    {
        return new CharacterUpdateEntity(
            $request->getGender(),
            $request->getName(),
            $request->getCulture(),
            $request->getBorn(),
            $request->getDied()
        );
    }
}
