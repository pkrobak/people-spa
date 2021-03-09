<?php

namespace App\Entities\Character;

class CharacterUpdateEntity
{
    /**
     * @var ?string
     */
    private $gender;
    /**
     * @var ?string
     */
    private $name;
    /**
     * @var ?string
     */
    private $culture;
    /**
     * @var ?string
     */
    private $born;
    /**
     * @var ?string
     */
    private $died;

    /**
     * CharacterUpdateEntity constructor.
     * @param string|null $gender
     * @param string|null $name
     * @param string|null $culture
     * @param string|null $born
     * @param string|null $died
     */
    public function __construct(?string $gender, ?string $name, ?string $culture, ?string $born, ?string $died)
    {
        $this->gender = $gender;
        $this->name = $name;
        $this->culture = $culture;
        $this->born = $born;
        $this->died = $died;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getCulture(): ?string
    {
        return $this->culture;
    }

    /**
     * @return string|null
     */
    public function getBorn(): ?string
    {
        return $this->born;
    }

    /**
     * @return string|null
     */
    public function getDied(): ?string
    {
        return $this->died;
    }

    /**
     * @return null[]|string[]
     */
    public function toArray(): array
    {
        return [
            'name' => $this->getName(),
            'gender' => $this->getGender(),
            'culture' => $this->getCulture(),
            'born' => $this->getBorn(),
            'died' => $this->getDied(),
        ];
    }
}
