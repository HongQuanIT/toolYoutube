<?php

namespace App\Http\Controllers\Api;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;

class YoutubeApiController extends BaseApiController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        try {
            return $this->sendSuccessData([
                'data' => 'ok',
            ]);
        } catch (Throwable $exception) {
            $this->getLogger()->error($exception);
            return $this->setMessage($exception->getMessage())->sendErrorData();
        }
    }
    public function uploadvideo(Request $request)
    {
        try {
            return $this->sendSuccessData($request->all());
        } catch (Throwable $exception) {
            $this->getLogger()->error($exception);
            return $this->setMessage($exception->getMessage())->sendErrorData();
        }
    }
}