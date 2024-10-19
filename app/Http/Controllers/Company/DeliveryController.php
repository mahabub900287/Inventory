<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use App\Models\Delivery;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\DataTables\Company\DeliveryDataTable;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use App\Services\Company\Product\ProductService;
use App\Notifications\ProductDeliveryNotification;
use App\Services\Company\Delivery\DeliveryService;
use App\Http\Requests\Company\DeliveryStoreRequest;

class DeliveryController extends Controller
{
    protected $deliveryService;
    protected $productService;
    public function __construct(DeliveryService $deliveryService, ProductService $productService)
    {
        $this->deliveryService = $deliveryService;
        $this->productService = $productService;
    }

    public function index(DeliveryDataTable $dataTable)
    {
        setbreadcumb("Delivery List", "Delivery");
        return $dataTable->render('company.delivery.index');
    }

    public function create()
    {

        $warehouses = WareHouse::get();
        setbreadcumb("Delivery Create", "Delivery");
        return view('company.delivery.create', compact('warehouses'));
    }


    public function store(DeliveryStoreRequest $request)
    {
        $data = $request->validated();
        try {
            if ($this->deliveryService->createOrUpdate($data)) {
                $notify[] = ['success', 'Delivery Product Create successful'];
                return redirect()->route('company.delivery.index')->withNotify($notify);
            } else {
                $notify[] = ['error', 'Delivery Product Create failed'];
                return redirect()->route('company.delivery.index')->withNotify($notify);
            }
        } catch (\Throwable $th) {
            $notify[] = ['error', $th];
            return redirect()->route('company.delivery.index')->withNotify($notify);
        }
        return redirect()->route('company.delivery.index');
    }


    public function show($id)
    {
        setbreadcumb("Delivery Show", "Delivery");
        $delivery = $this->deliveryService->get($id, ['deliveryProducts.products']);
        return view('company.delivery.show', compact('delivery'));
    }


    public function edit($id)
    {
        setbreadcumb("Delivery Edit", "Delivery");
        $delivery = $this->deliveryService->get($id, ['deliveryProducts', 'deliveryProducts.products', 'deliveryBundles', 'deliveryBundles.bundles']);
        //  dd($delivery);
        $products = $this->productService->get();
        $warehouses = WareHouse::get();
        return view('company.delivery.edit', compact('delivery', 'products', 'warehouses'));
    }


    public function update(DeliveryStoreRequest $request, $id)
    {
        $data = $request->validated();
        try {
            if ($this->deliveryService->createOrUpdate($data, $id)) {
                $notify[] = ['success', 'Delivery Product Update successfully'];
                return redirect()->route('company.delivery.index')->withNotify($notify);
            } else {
                $notify[] = ['error', 'Delivery Product Update failed'];
                return redirect()->route('company.delivery.index')->withNotify($notify);
            }
        } catch (\Throwable $th) {
            $notify[] = ['error', 'Something went wrong'];
            return redirect()->route('company.delivery.index')->withNotify($notify);
        }
        return redirect()->route('company.delivery.index');
    }

    public function destroy($id)
    {
        try {
            $this->deliveryService->deleteItem($id);
            $notify[] = ['success', 'Delivery Product Deleted successfully'];
            return redirect()->route('company.delivery.index')->withNotify($notify);
        } catch (\Throwable $th) {
            $notify[] = ['error', 'Something went wrong'];
            return redirect()->route('company.delivery.index')->withNotify($notify);
        }
    }
    public function status_change(Request $request)
    {
        dd($request->all());
        try {
            if ($request->itemType == 'bundle') {
                $item = Delivery::findOrFail($request->productId);
            } else {
                $item = Delivery::findOrFail($request->productId);
            }
            $status = $item->status == 'active' ? 'inactive' : 'active';
            $item->update([
                'status' => $status,
            ]);
            return response()->json(['success' => true, 'updatedStatus' => $status, 'productId' => $request->productId, 'itemType' => $request->itemType]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    public function sendToWarehouse($id)
    {
        $delivery = $this->deliveryService->get($id);
        $delivery->status = Delivery::PROCESSING_STATUS;
        $delivery->save();
        $notify[] = ['success', 'Product Send to Warehouse successfully'];
        $offerData = [
            'title' => 'Delivery Product',
            'msg'   => auth()->user()->first_name . ' ' . auth()->user()->last_name . ' has recently create a new product delivery request',
            'body'  => 'Client want to send warehouse.',
            'url'   => route('admin.delivery.show', $id),
        ];
        $userSchema = User::where('type', 'admin')->get();
        foreach ($userSchema as $user) {
            $user->notify(new ProductDeliveryNotification($offerData));
        }
        return redirect()->route('company.delivery.index')->withNotify($notify);
    }
    public function bulk_action(Request $request)
    {
        try {
            $item = Delivery::whereIn('id', $request->ids)->get();
            if ($item->count() > 0) {
                Delivery::whereIn('id', $request->ids)->delete();
                return response()->json(['status' => 'ok']);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
