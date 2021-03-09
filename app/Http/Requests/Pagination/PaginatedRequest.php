<?php

namespace App\Http\Requests\Pagination;

use Illuminate\Foundation\Http\FormRequest;

abstract class PaginatedRequest extends FormRequest implements PaginationRequestInterface
{
    const PAGE = 'page';

    public function authorize(): bool
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge([
            self::PAGE => 'nullable|int|min:1'
        ], $this->ownRules());
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return (int)$this->request->get(self::PAGE, 1);
    }
}
