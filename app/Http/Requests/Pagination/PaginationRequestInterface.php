<?php


namespace App\Http\Requests\Pagination;


interface PaginationRequestInterface
{
    /**
     * @return array
     */
    public function ownRules(): array;
}
