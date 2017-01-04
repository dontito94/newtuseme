<?php

use Faker\Factory as Faker;
use App\Models\riport;
use App\Repositories\riportRepository;

trait MakeriportTrait
{
    /**
     * Create fake instance of riport and save it in database
     *
     * @param array $riportFields
     * @return riport
     */
    public function makeriport($riportFields = [])
    {
        /** @var riportRepository $riportRepo */
        $riportRepo = App::make(riportRepository::class);
        $theme = $this->fakeriportData($riportFields);
        return $riportRepo->create($theme);
    }

    /**
     * Get fake instance of riport
     *
     * @param array $riportFields
     * @return riport
     */
    public function fakeriport($riportFields = [])
    {
        return new riport($this->fakeriportData($riportFields));
    }

    /**
     * Get fake data of riport
     *
     * @param array $postFields
     * @return array
     */
    public function fakeriportData($riportFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'position' => $fake->word,
            'introduction' => $fake->word,
            'description' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $riportFields);
    }
}
