<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Response\CustomApiResponse;
use App\Repositories\CityRepository;
use App\Http\Requests\CityValidationRequest;

/**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Weather Api documentation",
     *      description="Weather Api documentation",
     *      @OA\Contact(
     *          email="kuriyamehul@gmail.com"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="Demo API Server"
     * )

     *
     * @OA\Tag(
     *     name="Weather Api",
     *     description="API Endpoints of Weather Api"
     * )
     */

class CityController extends Controller
{

    /**
     * @var CityRepository
     */
    private $cityRepository;

    /**
     * @var CustomApiResponse
     */
    private $apiResponse;

    public function __construct(
        CustomApiResponse $customApiResponse,
        CityRepository $cityRepository
    ) {
        $this->apiResponse = $customApiResponse;
        $this->cityRepository = $cityRepository;
    }

   
     /**
     * @OA\POST(
     *      path="/v1/city/add",
     *      operationId="storeCity",
     *      tags={"storeCity"},
     *      summary="Store City Data",
     *      description="Returns list of city along with weather",
     *      
     *      *@OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         description="City name parameters",
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         example="Ahmedabad"
     *     ),
     * 
     *      *@OA\Parameter(
     *         name="state_uuid",
     *         in="query",
     *         required=true,
     *         description="state_uuid",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         example="7cb5fb96-4a32-4793-abe2-0c1c9f781ea2"
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Content",
     *      ),
     *      
     *      @OA\Response(
     *          response=404,
     *          description="Resource not found"
     *      ),
     * 
     *       @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *      ),
     *     )
     */

     /* Store City API */

    public function store(CityValidationRequest $request)
    {
        try {
            $cityInfo = $this->cityRepository->store($request);
            return $this->apiResponse->getResponseStructure('true', $cityInfo, 'City info save successfully.!');
        } catch (\Exception $e) {
            return $this->apiResponse->handleAndResponseException($e);
        }
    }

   
     /**
     * @OA\Get(
     *      path="/v1/fetch-city-weather",
     *      operationId="fetch-city-weather",
     *      tags={"City weather"},
     *      summary="Get list of city weather",
     *      description="Returns list of city along with weather",
     *      
     *      *@OA\Parameter(
     *         name="city",
     *         in="query",
     *         required=false,
     *         description="City name parameters",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *         )
     *     ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource not found"
     *      ),
     * 
     *       @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *      ),
     *     )
     */
     /* Fetch City Weather API */

    public function fetchCityWeather(Request $request)
    {
        try {
            $cityInfo = $this->cityRepository->fetchCityWeather($request);
            return $this->apiResponse->getResponseStructure('true', $cityInfo, 'City with weather fetched successfully.!');
        } catch (\Exception $e) {
            return $this->apiResponse->handleAndResponseException($e);
        }
    }
}
