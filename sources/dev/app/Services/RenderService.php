<?php

namespace App\Services;


use DB;
use Exception;
use Throwable;
use Auth;
use App\Models\Render;

class RenderService
{
    public function getListFrame()
    {
        return Render::get(['id', 'name'])->toArray();
    }
    public function getDetailFrame($id)
    {
        return Render::findOrFail($id);
    }
}