<?php

namespace App\Http\Controllers\Api\Panel;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\Panel\PanelService;
use Illuminate\Http\Request;

class PanelController extends Controller
{

    private PanelService $panelService;
    public function __construct(PanelService $panelService){
            $this->panelService=$panelService;
    }


    public function index(){
        return $this->panelService->index();
    }
    public function locale(){
        return app()->getLocale();
    }
}
