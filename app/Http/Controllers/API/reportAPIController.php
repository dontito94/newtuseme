<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatereportAPIRequest;
use App\Http\Requests\API\UpdatereportAPIRequest;
use App\Models\report;
use App\Repositories\reportRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class reportController
 * @package App\Http\Controllers\API
 */

class reportAPIController extends AppBaseController
{
    /** @var  reportRepository */
    private $reportRepository;

    public function __construct(reportRepository $reportRepo)
    {
        $this->reportRepository = $reportRepo;
    }

    /**
     * Display a listing of the report.
     * GET|HEAD /reports
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->reportRepository->pushCriteria(new RequestCriteria($request));
        $this->reportRepository->pushCriteria(new LimitOffsetCriteria($request));
        $reports = $this->reportRepository->all();

        return $this->sendResponse($reports->toArray(), 'Reports retrieved successfully');
    }

    /**
     * Store a newly created report in storage.
     * POST /reports
     *
     * @param CreatereportAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatereportAPIRequest $request)
    {
        $input = $request->all();

        $reports = $this->reportRepository->create($input);

        return $this->sendResponse($reports->toArray(), 'Report saved successfully');
    }

    /**
     * Display the specified report.
     * GET|HEAD /reports/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var report $report */
        $report = $this->reportRepository->findWithoutFail($id);

        if (empty($report)) {
            return $this->sendError('Report not found');
        }

        return $this->sendResponse($report->toArray(), 'Report retrieved successfully');
    }

    /**
     * Update the specified report in storage.
     * PUT/PATCH /reports/{id}
     *
     * @param  int $id
     * @param UpdatereportAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatereportAPIRequest $request)
    {
        $input = $request->all();

        /** @var report $report */
        $report = $this->reportRepository->findWithoutFail($id);

        if (empty($report)) {
            return $this->sendError('Report not found');
        }

        $report = $this->reportRepository->update($input, $id);

        return $this->sendResponse($report->toArray(), 'report updated successfully');
    }

    /**
     * Remove the specified report from storage.
     * DELETE /reports/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var report $report */
        $report = $this->reportRepository->findWithoutFail($id);

        if (empty($report)) {
            return $this->sendError('Report not found');
        }

        $report->delete();

        return $this->sendResponse($id, 'Report deleted successfully');
    }
}
