<?php

namespace App\Console\Commands;

use App\Entities\CharacterEntity;
use App\Exceptions\InvalidGenderException;
use App\Repository\CharacterRepository;
use App\Service\IceOnFireApiService;
use Exception;
use Illuminate\Console\Command;
use Throwable;

class CharactersDownloadCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'characters:download {--count=50}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download characters via API';
    /**
     * @var CharacterRepository
     */
    private $characterRepository;
    /**
     * @var IceOnFireApiService
     */
    private $apiService;

    /**
     * Create a new command instance.
     *
     * @param CharacterRepository $characterRepository
     * @param IceOnFireApiService $apiService
     */
    public function __construct(
        CharacterRepository $characterRepository,
        IceOnFireApiService $apiService
    )
    {
        parent::__construct();
        $this->characterRepository = $characterRepository;
        $this->apiService = $apiService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $charactersDownloadCount = $this->option('count');
        $limit = IceOnFireApiService::MAXIMUM_REQUESTS / IceOnFireApiService::PER_PAGE;
        if ($charactersDownloadCount >= $limit) {
            $this->error('Due to api limitations you are not able to get more than ' . $limit . ' users per day');

            return 0;
        }
        try {
            $responseEntity = $this->apiService->getCharacters($charactersDownloadCount);
        } catch (Exception $exception) {
            $this->error($exception->getMessage());

            return 0;
        }

        try {
            $responseEntity->getCharacters()->each(function (CharacterEntity $characterEntity) use ($responseEntity) {
                $this->characterRepository->attachTitle(
                    $this->characterRepository->insertFromApi($characterEntity),
                    $responseEntity->getTitles()
                        ->whereIn('name', $characterEntity->getTitles())
                        ->pluck('id')
                        ->unique()
                        ->toArray()
                );
            });
        } catch (InvalidGenderException $e) {
            $this->error('Invalid data');

            return 0;
        } catch (Throwable $exception) {
            $this->error('Something went wrong');

            return 0;
        }
        $this->info('Successfully added ' . $responseEntity->getCharacters()->count() . ' characters.');

        return 1;
    }
}
