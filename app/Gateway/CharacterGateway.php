<?php


namespace App\Gateway;


use App\Models\Character;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CharacterGateway
{
    /**
     * @var Character
     */
    private $character;

    /**
     * CharacterGateway constructor.
     * @param Character $character
     */
    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    /**
     * @param string|null $url
     * @param string|null $name
     * @param string|null $gender
     * @param string|null $culture
     * @param string|null $born
     * @param string|null $died
     * @return Character
     */
    public function insert(?string $url, ?string $name, ?string $gender, ?string $culture, ?string $born, ?string $died): Character
    {
        return Character::create([
            'url' => $url,
            'name' => $name,
            'gender' => $gender,
            'culture' => $culture,
            'born' => $born,
            'died' => $died,
        ]);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return Character::count();
    }

    /**
     * @param string|null $name
     * @param string|null $gender
     * @return LengthAwarePaginator
     */
    public function all(?string $name, ?string $gender): LengthAwarePaginator
    {
        $query = Character::query();
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        if ($gender) {
            $query->where('gender', $gender);
        }

        return $query->paginate(10);
    }

    /**
     * @param Character $character
     * @param array $titlesIds
     */
    public function attachTitle(Character $character, array $titlesIds): void
    {
        $character->titles()->attach($titlesIds);
    }

    /**
     * @param Character $character
     * @param array $data
     * @return bool
     */
    public function update(Character $character, array $data): bool
    {
        return $character->update($data);
    }
}
