<?php

namespace App\Http\Controllers\Api\Evaluation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Evaluation\StoreEvaluation;
use App\Http\Resources\Evaluation\EvaluationResource;
use App\Services\Evaluation\EvaluationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\JsonResponse;
class EvaluationController extends Controller
{
    /**
     * @param EvaluationService $evaluationService
     *
     */
    public function __construct(private EvaluationService $evaluationService)
    {
        $this->evaluationService = $evaluationService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index($company)
    {
       return EvaluationResource::collection($this->evaluationService->getEvaluationCompany($company));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEvaluation $request,$company):JsonResponse
    {
        return Response::json(new EvaluationResource($this->evaluationService->store($request->validated(),$company)),HttpResponse::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
