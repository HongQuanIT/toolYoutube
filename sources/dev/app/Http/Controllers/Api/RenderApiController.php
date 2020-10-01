<?php

namespace App\Http\Controllers\Api;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use App\Services\RenderService;

class RenderApiController extends BaseApiController
{
    protected $service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RenderService $renderService)
    {
        $this->service = $renderService;
    }

    public function listFrame(Request $request)
    {
        try {
            return $this->sendSuccessData($this->service->getListFrame());
        } catch (Throwable $exception) {
            $this->getLogger()->error($exception);
            return $this->setMessage($exception->getMessage())->sendErrorData();
        }
    }
    public function getFrame($id)
    {
        try {
            return $this->sendSuccessData($this->service->getDetailFrame($id));
        } catch (Throwable $exception) {
            $this->getLogger()->error($exception);
            return $this->setMessage($exception->getMessage())->sendErrorData();
        }
    }
}