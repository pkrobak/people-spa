<?php


namespace App\Service;


use App\Entities\API\CharacterResponseEntity;
use App\Exceptions\CharacterDownloader\ApiLimitExceededException;
use App\Exceptions\CharacterDownloader\DataParseException;
use App\Exceptions\CharacterDownloader\InvalidRequestException;
use App\Exceptions\CharacterDownloader\InvalidResponseCodeException;
use App\Exceptions\IncorrectDataParameters;
use App\Factory\CharactersCollectionFactory;
use App\Factory\TitleCollectionFactory;
use App\Repository\CharacterRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class IceOnFireApiService
{
    const URL = 'https://anapioficeandfire.com/api/characters';
    const PER_PAGE = 10;
    const MAXIMUM_REQUESTS = 2000;

    /**
     * @var CharactersCollectionFactory
     */
    private $charactersCollectionFactory;
    /**
     * @var TitleCollectionFactory
     */
    private $titleCollectionFactory;
    /**
     * @var CharacterRepository
     */
    private $characterRepository;

    /**
     * IceOnFireApiService constructor.
     * @param CharactersCollectionFactory $charactersCollectionFactory
     * @param TitleCollectionFactory $titleCollectionFactory
     * @param CharacterRepository $characterRepository
     */
    public function __construct(
        CharactersCollectionFactory $charactersCollectionFactory,
        TitleCollectionFactory $titleCollectionFactory,
        CharacterRepository $characterRepository
    ) {
        $this->charactersCollectionFactory = $charactersCollectionFactory;
        $this->titleCollectionFactory = $titleCollectionFactory;
        $this->characterRepository = $characterRepository;
    }

    /**
     * @param int $charactersDownloadCount
     * @return CharacterResponseEntity
     * @throws DataParseException
     * @throws IncorrectDataParameters
     * @throws InvalidRequestException
     * @throws InvalidResponseCodeException
     * @throws ApiLimitExceededException
     */
    public function getCharacters(int $charactersDownloadCount): CharacterResponseEntity
    {
        $responses = $this->getAllResponses($charactersDownloadCount);

        return new CharacterResponseEntity(
            $this->charactersCollectionFactory->create(array_merge(...$responses)),
            $this->titleCollectionFactory->create($this->getTitles($responses))->unique() // nie wiem w sumie czytutaj nie popelnilem bledu, ze ustawiam tytuly w tej encji mimo tego, że moglbym je wyciagnąć z property characters pozniej, ale szkoda mi czasu na poprawe
        );
    }

    /**
     * @param int $charactersDownloadCount
     * @return array
     * @throws DataParseException
     * @throws InvalidRequestException
     * @throws InvalidResponseCodeException
     * @throws ApiLimitExceededException
     */
    private function getAllResponses(int $charactersDownloadCount): array
    {
        $responses = [];
        $initialPage = $this->getInitialPage();
        for (
            $page = $initialPage; // gdybym robił to komercyjnie, o ile byloby inne zrodlo dodawnia postaci zrobilbym to inaczej
            $page < $initialPage + ($charactersDownloadCount / self::PER_PAGE);
            $page++
        ) {
            $response = Http::get(self::URL, ['page' => $page]);
            if ($response->clientError()) {
                throw new InvalidRequestException('Invalid request');
            }
            if ($response->status() === Response::HTTP_FORBIDDEN) {
                throw new ApiLimitExceededException('You exceeded request limit in API');
            }
            if (!$response->ok()) {
                throw new InvalidResponseCodeException('Failed due to invalid response status code');
            }
            $response = json_decode($response->body(), true);
            if (!is_array($response)) {
                throw new DataParseException('Response parse error');
            }

            $responses[] = $response;
        }

        return $responses;
    }

    /**
     * @param array $responses
     * @return array
     */
    private function getTitles(array $responses): array
    {
        $result = [];
        foreach ($responses as $response) {
            foreach (array_column($response, 'titles') as $titles) {
                foreach ($titles as $title) {
                    if (!empty($title)) {
                        $result[] = $title;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * @return int
     */
    private function getInitialPage(): int
    {
        return (int)ceil(($this->characterRepository->count() ?? 1) / self::PER_PAGE);
    }
}
