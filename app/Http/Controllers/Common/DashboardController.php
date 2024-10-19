<?php

namespace App\Http\Controllers\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Common\DashboardService;
use League\CommonMark\Extension\SmartPunct\DashParser;

class DashboardController extends Controller
{

    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {

        $this->dashboardService = $dashboardService;
    }
    public function adminIndex()
    {
        $products = $this->dashboardService->productsCount();
        $user = $this->dashboardService->userCount();
        $bundles = $this->dashboardService->bundlesCount();
        $deliveries = $this->dashboardService->deliveriesCount();
        $shipments = $this->dashboardService->shipmentsCount();
        $shipments_procrssing = $this->dashboardService->shipmentsProgressCount();
        $shipments_complete = $this->dashboardService->shipmentsCompleteCount();
        $shipments_return = $this->dashboardService->shipmentsReturnCount();
        $all_complete_shipment = $this->dashboardService->monthlyCompleteCountLastYear();
        $all_return_shipment = $this->dashboardService->monthlyReturnCountLastYear();
        return view('common.adminDashboard', compact('products', 'bundles', 'deliveries', 'shipments', 'user', 'shipments_procrssing', 'shipments_complete', 'shipments_return', 'all_complete_shipment', 'all_return_shipment'));
    }
    public function companyIndex()
    {
        $authId = auth()->user()->id;
        $products = $this->dashboardService->productsCount($authId);
        $bundles = $this->dashboardService->bundlesCount($authId);
        $deliveries = $this->dashboardService->deliveriesCount($authId);
        $shipments = $this->dashboardService->shipmentsCount($authId);
        $shipments_procrssing = $this->dashboardService->shipmentsProgressCount($authId);
        $shipments_complete = $this->dashboardService->shipmentsCompleteCount($authId);
        $shipments_return = $this->dashboardService->shipmentsReturnCount($authId);
        $all_complete_shipment = $this->dashboardService->monthlyCompleteCountLastYear($authId);
        $all_return_shipment = $this->dashboardService->monthlyReturnCountLastYear($authId);
        return view('common.dashboard', compact('products', 'bundles', 'deliveries', 'shipments', 'shipments_procrssing', 'shipments_complete', 'shipments_return', 'all_complete_shipment', 'all_return_shipment'));
    }
}
