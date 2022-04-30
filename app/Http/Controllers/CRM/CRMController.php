<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use App\Services\CrmServices;

class CrmController extends Controller
{
    /**
     * Service for the controller.
     *
     * @var CrmServices
     */

    /**
     * UserController constructor.
     *
     * @param CrmServices $service
     */
    public function __construct(CrmServices $service)
    {
        $this->service = $service;
    }
    protected $service;

    public function index()
    {
        $data = $this->service->getListData();

        return view('crm.index', ['data' => $data]);
    }
}
