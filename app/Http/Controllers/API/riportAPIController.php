<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateriportAPIRequest;
use App\Http\Requests\API\UpdateriportAPIRequest;
use App\Models\riport;
use App\Repositories\riportRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class riportController
 * @package App\Http\Controllers\API
 */

class riportAPIController extends AppBaseController
{
    /** @var  riportRepository */
    private $riportRepository;

    public function __construct(riportRepository $riportRepo)
    {
        $this->riportRepository = $riportRepo;
    }

    /**
     * Display a listing of the riport.
     * GET|HEAD /riports
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->riportRepository->pushCriteria(new RequestCriteria($request));
        $this->riportRepository->pushCriteria(new LimitOffsetCriteria($request));
        $riports = $this->riportRepository->all();

        return $this->sendResponse($riports->toArray(), 'Riports retrieved successfully');
    }

    /**
     * Store a newly created riport in storage.
     * POST /riports
     *
     * @param CreateriportAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateriportAPIRequest $request)
    {
        $input = $request->all();

        $riports = $this->riportRepository->create($input);

        return $this->sendResponse($riports->toArray(), 'Riport saved successfully');
    }

    /**
     * Display the specified riport.
     * GET|HEAD /riports/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var riport $riport */
        $riport = $this->riportRepository->findWithoutFail($id);

        if (empty($riport)) {
            return $this->sendError('Riport not found');
        }

        return $this->sendResponse($riport->toArray(), 'Riport retrieved successfully');
    }

    /**
     * Update the specified riport in storage.
     * PUT/PATCH /riports/{id}
     *
     * @param  int $id
     * @param UpdateriportAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateriportAPIRequest $request)
    {
        $input = $request->all();

        /** @var riport $riport */
        $riport = $this->riportRepository->findWithoutFail($id);

        if (empty($riport)) {
            return $this->sendError('Riport not found');
        }

        $riport = $this->riportRepository->update($input, $id);

        return $this->sendResponse($riport->toArray(), 'riport updated successfully');
    }

    /**
     * Remove the specified riport from storage.
     * DELETE /riports/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var riport $riport */
        $riport = $this->riportRepository->findWithoutFail($id);

        if (empty($riport)) {
            return $this->sendError('Riport not found');
        }

        $riport->delete();

        return $this->sendResponse($id, 'Riport deleted successfully');
    }
}
