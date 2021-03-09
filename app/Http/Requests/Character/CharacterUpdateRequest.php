<?php

namespace App\Http\Requests\Character;

use App\Http\Requests\Pagination\PaginatedRequest;
use App\Models\Character;

class CharacterUpdateRequest extends PaginatedRequest
{
    const GENDER = 'gender';
    const NAME = 'name';
    const CULTURE = 'culture';
    const BORN = 'born';
    const DIED = 'died';

    /**
     * @return array
     */
    public function ownRules(): array
    {
        return [
            self::GENDER => 'nullable|in:' . implode(',', Character::GENDERS),
            self::NAME => 'nullable|string|max:255',
            self::CULTURE => 'nullable|string|max:255',
            self::BORN => 'nullable|string|max:255',
            self::DIED => 'nullable|string|max:255',
        ];
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->request->get(self::GENDER);
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->request->get(self::NAME);
    }

    /**
     * @return string|null
     */
    public function getCulture(): ?string
    {
        return $this->request->get(self::CULTURE);
    }

    /**
     * @return string|null
     */
    public function getBorn(): ?string
    {
        return $this->request->get(self::BORN);
    }

    /**
     * @return string|null
     */
    public function getDied(): ?string
    {
        return $this->request->get(self::DIED);
    }
}
