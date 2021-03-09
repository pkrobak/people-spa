<?php

namespace App\Http\Requests\Character;

use App\Http\Requests\Pagination\PaginatedRequest;
use App\Models\Character;

class CharacterIndexRequest extends PaginatedRequest
{
    const GENDER = 'gender';
    const NAME = 'name';

    /**
     * @return array
     */
    public function ownRules(): array
    {
        return [
            self::GENDER => 'nullable|in:' . implode(',', Character::GENDERS),
            self::NAME => 'nullable|string',
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
}
