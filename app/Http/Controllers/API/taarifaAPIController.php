<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatetaarifaAPIRequest;
use App\Http\Requests\API\UpdatetaarifaAPIRequest;
use App\Models\taarifa;
use App\Repositories\taarifaRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class taarifaController
 * @package App\Http\Controllers\API
 */

class taarifaAPIController extends AppBaseController
{
    /** @var  taarifaRepository */
    private $taarifaRepository;

    public function __construct(taarifaRepository $taarifaRepo)
    {
        $this->taarifaRepository = $taarifaRepo;
    }

    /**
     * Display a listing of the taarifa.
     * GET|HEAD /taarifas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->taarifaRepository->pushCriteria(new RequestCriteria($request));
        $this->taarifaRepository->pushCriteria(new LimitOffsetCriteria($request));
        $taarifas = $this->taarifaRepository->all();

        return $this->sendResponse($taarifas->toArray(), 'Taarifas retrieved successfully');
    }

    /**
     * Store a newly created taarifa in storage.
     * POST /taarifas
     *
     * @param CreatetaarifaAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatetaarifaAPIRequest $request)
    {
        $input = $request->all();

        $taarifas = $this->taarifaRepository->create($input);

        return $this->sendResponse($taarifas->toArray(), 'Taarifa saved successfully');
    }

    /**
     * Display the specified taarifa.
     * GET|HEAD /taarifas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var taarifa $taarifa */
        $taarifa = $this->taarifaRepository->findWithoutFail($id);

        if (empty($taarifa)) {
            return $this->sendError('Taarifa not found');
        }

        return $this->sendResponse($taarifa->toArray(), 'Taarifa retrieved successfully');
    }

    /**
     * Update the specified taarifa in storage.
     * PUT/PATCH /taarifas/{id}
     *
     * @param  int $id
     * @param UpdatetaarifaAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetaarifaAPIRequest $request)
    {
        $input = $request->all();

        /** @var taarifa $taarifa */
        $taarifa = $this->taarifaRepository->findWithoutFail($id);

        if (empty($taarifa)) {
            return $this->sendError('Taarifa not found');
        }

        $taarifa = $this->taarifaRepository->update($input, $id);

        return $this->sendResponse($taarifa->toArray(), 'taarifa updated successfully');
    }

    /**
     * Remove the specified taarifa from storage.
     * DELETE /taarifas/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var taarifa $taarifa */
        $taarifa = $this->taarifaRepository->findWithoutFail($id);

        if (empty($taarifa)) {
            return $this->sendError('Taarifa not found');
        }

        $taarifa->delete();

        return $this->sendResponse($id, 'Taarifa deleted successfully');
    }
}
