<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatemaoniAPIRequest;
use App\Http\Requests\API\UpdatemaoniAPIRequest;
use App\Models\maoni;
use App\Repositories\maoniRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class maoniController
 * @package App\Http\Controllers\API
 */

class maoniAPIController extends AppBaseController
{
    /** @var  maoniRepository */
    private $maoniRepository;

    public function __construct(maoniRepository $maoniRepo)
    {
        $this->maoniRepository = $maoniRepo;
    }

    /**
     * Display a listing of the maoni.
     * GET|HEAD /maonis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->maoniRepository->pushCriteria(new RequestCriteria($request));
        $this->maoniRepository->pushCriteria(new LimitOffsetCriteria($request));
        $maonis = $this->maoniRepository->all();

        return $this->sendResponse($maonis->toArray(), 'Maonis retrieved successfully');
    }

    /**
     * Store a newly created maoni in storage.
     * POST /maonis
     *
     * @param CreatemaoniAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatemaoniAPIRequest $request)
    {
        $input = $request->all();

        $maonis = $this->maoniRepository->create($input);

        return $this->sendResponse($maonis->toArray(), 'Maoni saved successfully');
    }

    /**
     * Display the specified maoni.
     * GET|HEAD /maonis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var maoni $maoni */
        $maoni = $this->maoniRepository->findWithoutFail($id);

        if (empty($maoni)) {
            return $this->sendError('Maoni not found');
        }

        return $this->sendResponse($maoni->toArray(), 'Maoni retrieved successfully');
    }

    /**
     * Update the specified maoni in storage.
     * PUT/PATCH /maonis/{id}
     *
     * @param  int $id
     * @param UpdatemaoniAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemaoniAPIRequest $request)
    {
        $input = $request->all();

        /** @var maoni $maoni */
        $maoni = $this->maoniRepository->findWithoutFail($id);

        if (empty($maoni)) {
            return $this->sendError('Maoni not found');
        }

        $maoni = $this->maoniRepository->update($input, $id);

        return $this->sendResponse($maoni->toArray(), 'maoni updated successfully');
    }

    /**
     * Remove the specified maoni from storage.
     * DELETE /maonis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var maoni $maoni */
        $maoni = $this->maoniRepository->findWithoutFail($id);

        if (empty($maoni)) {
            return $this->sendError('Maoni not found');
        }

        $maoni->delete();

        return $this->sendResponse($id, 'Maoni deleted successfully');
    }
}
