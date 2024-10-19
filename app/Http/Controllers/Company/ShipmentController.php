<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use App\Models\Bundle;
use App\Models\Country;
use App\Models\Shipment;
use App\Models\WareHouse;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;
use App\Http\Controllers\Controller;
use App\DataTables\Company\ShipmentDataTable;
use App\DataTables\Company\ShipmentRetunDataTable;
use App\Http\Requests\Company\ShipmentRequest;
use App\Notifications\ProductDeliveryNotification;
use App\Services\Company\Shipment\ShipmentService;

class ShipmentController extends Controller
{
    protected $shipmentservice;

    public function __construct(ShipmentService $shipmentservice)
    {
        $this->shipmentservice = $shipmentservice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShipmentDataTable $dataTable)
    {
        setbreadcumb("Shipment List", "Shipment");
        return $dataTable->render('company.shipment.index');
    }

    public function return_shipment(ShipmentRetunDataTable $dataTable)
    {
        setbreadcumb("Shipment Return List", "Shipment Return");
        return $dataTable->render('company.shipment.return');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        setbreadcumb("Shipment Create", "Shipment");
        $warehouse = WareHouse::where('status', 'active')->get();
        $coustomer_address = CustomerAddress::with('country')->where('user_id', auth()->user()->id)->get();
        $countrys = Country::get();
        return view('company.shipment.create', compact('warehouse', 'countrys', 'coustomer_address'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipmentRequest $request)
    {
        $data = $request->validated();
        try {
            $shipment = $this->shipmentservice->storeOrUpdate($data);
            $this->shipmentservice->productShipment($data, $shipment->id);
            $offerData = [
                'title' => 'New Shipment',
                'msg' => auth()->user()->first_name . auth()->user()->last_name . ' has recently create a new product shipment request',
                'body' => 'New Shipment Created',
                'url' => route('admin.shipment.show', $shipment->id),
            ];
            $shipments = Shipment::findOrFail($shipment->id);
            $users = User::where('type', 'admin')->get();
            foreach ($users as $user) {
                $user->notify(new ProductDeliveryNotification($offerData));
            }
            $notify[] = ['success', 'Shipment Create successful'];
            return redirect()->route('company.shipment.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e];
            return redirect()->back()->withNotify($notify);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $item = $this->shipmentservice->get($id, ['get_product', 'customer_address', 'user']);
            if ($item->created_by == auth()->user()->id) {
                return view('company.shipment.show', compact('item'));
            } else {
                $notify[] = ['error', 'This product is not yours product'];
                return redirect()->route('company.shipment.index')->withNotify($notify);
            }
        } catch (\Exception $e) {
            $notify[] = ['error', 'Something is Wrong'];
            return redirect()->back()->withNotify($notify);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $item = $this->shipmentservice->get($id, ['get_product']);
            if ($item->created_by == auth()->user()->id) {
                $countrys = Country::get();
                $warehouse = WareHouse::where('status', 'active')->get();
                $coustomer_address = CustomerAddress::with('country')->where('user_id', auth()->user()->id)->get();
                setbreadcumb("Shipment Edit", "Shipment");
                return view('company.shipment.edit', compact('item', 'warehouse', 'countrys', 'coustomer_address'));
            } else {
                $notify[] = ['error', 'This product is not yours product'];
                return redirect()->route('company.shipment.index')->withNotify($notify);
            }
        } catch (\Exception $e) {
            $notify[] = ['error', 'Something is Wrong'];
            return redirect()->back()->withNotify($notify);
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShipmentRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $this->shipmentservice->storeOrUpdate($data, $id);
            $this->shipmentservice->productShipment($data, $id);
            $notify[] = ['success', 'Shipment update successful'];
            return redirect()->route('company.shipment.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e];
            return redirect()->back()->withNotify($notify);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->shipmentservice->delete($id);
            $notify[] = ['success', 'Shipment delete successfully'];
            return redirect()->route('company.shipment.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }

    public function product_stock(Request $request)
    {
        try {
            $wareHouseId = $request->ware_house_id;
            if (!is_null($wareHouseId)) {
                $type = $request->type;
                if ($type == 'product') {
                    $products = ProductStock::where('warehouse_id', $wareHouseId)
                        ->where('product_id', '!=', null)
                        ->where('stock', '>=', 1)
                        ->get();
                    // dd($products);
                    if (count($products) > 0) {
                        $returnHTML = view('company.shipment.product.manule_product', compact('products'))->render();
                        return response()->json(['html' => $returnHTML]);
                    } else {
                        return response()->json(['html' => 'product']);
                    }
                }
                if ($type == 'bundle') {
                    $products = ProductStock::where('warehouse_id', $wareHouseId)
                        ->where('bundle_id', '!=', null)
                        ->where('stock', '>=', 1)
                        ->get();

                    if (count($products) > 0) {
                        $returnHTML = view('company.shipment.product.bundle_product', compact('products'))->render();
                        return response()->json(['html' => $returnHTML]);
                    } else {
                        return response()->json(['html' => 'bundle']);
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function csv_product_shipment()
    {
        setbreadcumb("Shipment Create Csv", "Shipment");
        return view('company.shipment.csv');
    }
    public function csv_store_shipment(Request $request)
    {
        $data = $request->all();
        try {
            $this->shipmentservice->excelUpload($data);
            $notify[] = ['success', 'Product Update successful'];
            return redirect()->route('company.product.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function change_status($id, $status)
    {
        $shipment = Shipment::findOrFail($id);
        try {
            $shipment->status = $status;
            $shipment->save();
            $notify[] = ['success', 'Shipment Update successfully'];
            if ($status == Shipment::RETURN_REQUEST_STATUS) {
                $offerData = [
                    'title' => 'Shipment Return',
                    'msg' => auth()->user()->first_name . auth()->user()->last_name . ' has recently create a new return shipment request',
                    'body' => 'Shipment Return Request',
                    'url' => route('admin.shipment.show', $shipment->id),
                ];
                $shipments = Shipment::findOrFail($id);
                $users = User::where('type', 'admin')->get();
                foreach ($users as $user) {
                    $user->notify(new ProductDeliveryNotification($offerData));
                }
            }
            return redirect()->route('company.shipment.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function bulk_action(Request $request)
    {
        try {
            $item = Shipment::whereIn('id', $request->ids)->get();
            if ($item->count() > 0) {
                Shipment::whereIn('id', $request->ids)->delete();
                return response()->json(['status' => 'ok']);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
