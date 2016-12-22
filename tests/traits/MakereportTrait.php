<?php

use Faker\Factory as Faker;
use App\Models\report;
use App\Repositories\reportRepository;

trait MakereportTrait
{
    /**
     * Create fake instance of report and save it in database
     *
     * @param array $reportFields
     * @return report
     */
    public function makereport($reportFields = [])
    {
        /** @var reportRepository $reportRepo */
        $reportRepo = App::make(reportRepository::class);
        $theme = $this->fakereportData($reportFields);
        return $reportRepo->create($theme);
    }

    /**
     * Get fake instance of report
     *
     * @param array $reportFields
     * @return report
     */
    public function fakereport($reportFields = [])
    {
        return new report($this->fakereportData($reportFields));
    }

    /**
     * Get fake data of report
     *
     * @param array $postFields
     * @return array
     */
    public function fakereportData($reportFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'title' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $reportFields);
    }
}
