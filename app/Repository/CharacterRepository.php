<?php


namespace App\Repository;


use App\Entities\Character\CharacterUpdateEntity;
use App\Entities\CharacterEntity;
use App\Exceptions\InvalidGenderException;
use App\Gateway\CharacterGateway;
use App\Models\Character;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CharacterRepository
{
    /**
     * @var CharacterGateway
     */
    private $gateway;

    /**
     * CharacterRepository constructor.
     * @param CharacterGateway $gateway
     */
    public function __construct(CharacterGateway $gateway)
    {
        $this->gateway = $gateway;
    }


    /**
     * @param CharacterEntity $characterEntity
     * @return int
     * @throws InvalidGenderException
     */
    public function insertFromApi(CharacterEntity $characterEntity): Character
    {
        if (!in_array($characterEntity->getGender(), Character::GENDERS)) {
            throw new InvalidGenderException();
        }

        return $this->gateway->insert(
            $characterEntity->getUrl(),
            $characterEntity->getName(),
            $characterEntity->getGender(),
            $characterEntity->getCulture(),
            $characterEntity->getBorn(),
            $characterEntity->getDied()
        );
    }

    /**
     * @param Character $character
     * @param array $titlesIds
     */
    public function attachTitle(Character $character, array $titlesIds): void
    {
        $this->gateway->attachTitle($character, $titlesIds);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->gateway->count();
    }

    /**
     * @param string|null $name
     * @param string|null $gender
     * @return LengthAwarePaginator
     */
    public function getPaginatedByNameAndGender(?string $name, ?string $gender): LengthAwarePaginator
    {
        return $this->gateway->all($name, $gender); // chyba repo nie powinno zwracac LengthAwarePaginator'a tylko zwykla kolekcje i osobny serwis powinen paginowac dane, ale brak czasu
    }

    /**
     * @param Character $character
     * @param CharacterUpdateEntity $entity
     * @return bool
     */
    public function update(Character $character, CharacterUpdateEntity $entity): bool
    {
        return $this->gateway->update($character, $entity->toArray());
    }
}
