<?php

namespace App\Http\Controllers;

use App\Factory\CharacterUpdateEntityFactory;
use App\Http\Requests\Character\CharacterIndexRequest;
use App\Http\Requests\Character\CharacterUpdateRequest;
use App\Models\Character;
use App\Repository\CharacterRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CharacterController extends Controller
{

    /**
     * @param CharacterIndexRequest $request
     * @param CharacterRepository $characterRepository
     * @return LengthAwarePaginator
     */
    public function index(
        CharacterIndexRequest $request,
        CharacterRepository $characterRepository
    ): LengthAwarePaginator
    {
        return $characterRepository->getPaginatedByNameAndGender($request->getName(), $request->getGender());
    }

    /**
     * @param CharacterUpdateRequest $request
     * @param Character $character
     * @param CharacterRepository $repository
     * @param CharacterUpdateEntityFactory $factory
     * @return JsonResponse
     */
    public function update(
        CharacterUpdateRequest $request,
        Character $character,
        CharacterRepository $repository,
        CharacterUpdateEntityFactory $factory
    ): JsonResponse
    {
        if (!$repository->update($character, $factory->create($request))) {
            return response()->json([
                'message' => 'Failed to update'
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'character' => $character->refresh(),
        ]);
    }
}
