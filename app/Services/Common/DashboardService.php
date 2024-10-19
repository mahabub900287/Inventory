<?php

namespace App\Services\Common;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Bundle;
use App\Models\Delivery;
use App\Models\Product;
use App\Models\Shipment;
use Illuminate\Support\Arr;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use App\Services\Utilities\FileUploadService;

class DashboardService extends BaseService
{
	protected $model;
	protected $products;
	protected $bundles;
	protected $deliveries;
	protected $shipments;
	protected $users;
	protected $fileUploadService;

	public function __construct(FileUploadService $fileUploadService)
	{
		$this->fileUploadService = $fileUploadService;
		$this->model = User::class;
		$this->products = Product::class;
		$this->users = User::class;
		$this->bundles = Bundle::class;
		$this->deliveries = Delivery::class;
		$this->shipments = Shipment::class;
	}

	public function userCount($id = null)
	{
		$user = $this->users::where('type', 'company')->count();
		return $user;
	}
	public function productsCount($id = null)
	{
		if ($id) {
			$product = $this->products::where('created_by', $id)->count();
		} else {
			$product = $this->products::count();
		}
		return $product;
	}
	public function bundlesCount($id = null)
	{
		if ($id) {
			$bundles = $this->bundles::where('created_by', $id)->count();
		} else {
			$bundles = $this->bundles::count();
		}
		return $bundles;
	}
	public function deliveriesCount($id = null)
	{
		if ($id) {
			$deliveries = $this->deliveries::where('created_by', $id)->where('status', $this->deliveries::COMPLETED_STATUS)->count();
		} else {
			$deliveries = $this->deliveries::where('status', $this->deliveries::COMPLETED_STATUS)->count();
		}
		return $deliveries;
	}
	public function shipmentsCount($id = null)
	{
		if ($id) {
			$shipments = $this->shipments::where('created_by', $id)->count();
		} else {
			$shipments = $this->shipments::count();
		}
		return $shipments;
	}
	public function shipmentsProgressCount($id = null)
	{
		if ($id) {
			$shipments = $this->shipments::where('status', $this->shipments::PROCESSING_STATUS)->where('created_by', $id)->count();
		} else {
			$shipments = $this->shipments::where('status', $this->shipments::PROCESSING_STATUS)->count();
		}
		return $shipments;
	}
	public function shipmentsCompleteCount($id = null)
	{
		if ($id) {
			$shipments = $this->shipments::where('status', $this->shipments::SENT_STATUS)->where('created_by', $id)->count();
		} else {
			$shipments = $this->shipments::where('status', $this->shipments::SENT_STATUS)->count();
		}
		return $shipments;
	}
	public function shipmentsReturnCount($id = null)
	{
		if ($id) {
			$shipments = $this->shipments::where('status', $this->shipments::RETURN_STATUS)->where('created_by', $id)->count();
		} else {
			$shipments = $this->shipments::where('status', $this->shipments::RETURN_STATUS)->count();
		}
		return $shipments;
	}

	public function monthlyCompleteCountLastYear($id = null)
	{
		$lastYear = now()->subYear(); // Get the timestamp for one year ago

		if ($id) {
			$shipments = $this->shipments::where('created_by', $id)
				->where('status', $this->shipments::SENT_STATUS)
				->where('created_at', '>=', $lastYear)
				->get();
		} else {
			$shipments = $this->shipments::where('created_at', '>=', $lastYear)
				->where('status', $this->shipments::SENT_STATUS)
				->get();
		}

		// Get all months of the last year
		$allMonths = collect(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);

		// Group the shipments by month and get the count for each month
		$monthlyCounts = $allMonths->mapWithKeys(function ($month) use ($shipments) {
			return [$month => $shipments->filter(function ($shipment) use ($month) {
				return Carbon::parse($shipment->created_at)->format('M') === $month;
			})->count()];
		});

		return $monthlyCounts;
	}
	public function monthlyReturnCountLastYear($id = null)
	{
		$lastYear = now()->subYear(); // Get the timestamp for one year ago

		if ($id) {
			$shipments = $this->shipments::where('created_by', $id)
				->where('status', $this->shipments::RETURN_STATUS)
				->where('created_at', '>=', $lastYear)
				->get();
		} else {
			$shipments = $this->shipments::where('created_at', '>=', $lastYear)
				->where('status', $this->shipments::RETURN_STATUS)
				->get();
		}

		// Get all months of the last year
		$allMonths = collect(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']);

		// Group the shipments by month and get the count for each month
		$monthlyCounts = $allMonths->mapWithKeys(function ($month) use ($shipments) {
			return [$month => $shipments->filter(function ($shipment) use ($month) {
				return Carbon::parse($shipment->created_at)->format('M') === $month;
			})->count()];
		});

		return $monthlyCounts;
	}
}
