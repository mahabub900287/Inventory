<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Country;
use App\Models\Shipment;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\DataTables\Admin\ShipmentDataTable;
use App\DataTables\Admin\ShipmentReturnDataTable;
use App\Notifications\ProductDeliveryNotification;
use App\Services\Company\Shipment\ShipmentService;

class AdminShipmentController extends Controller
{
    protected $shipmentService;
    protected $apiKey;
    protected $apiSecret;
    protected $httpClient;

    public function __construct(ShipmentService $shipmentService)
    {
        $this->shipmentService = $shipmentService;
        $this->apiKey = 'QIGMDHhFTtaXUNcNTJbTLd6EVAPIGBdr';
        $this->apiSecret = 'XsLFVr2AjOCIpXaJ';
        $this->httpClient = new Client();
        $this->middleware('permission:All Shipment|Create Shipment|Edit Shipment|Delete Shipment', ['only' => ['index', 'store']]);
        $this->middleware('permission:Create Shipment', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Shipment', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Show Shipment', ['only' => ['show']]);
        $this->middleware('permission:Delete Shipment', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShipmentDataTable $dataTable)
    {
        setbreadcumb("Shipment List", "Shipment");
        return $dataTable->render('admin.shipment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        setbreadcumb("Shipment Show", "Shipment");
        $item = $this->shipmentService->get($id, ['get_product', 'customer_address', 'user']);
        return view('admin.shipment.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function dhl_create($id)
    {
        setbreadcumb("Shipment Dhl Create", "Shipment");
        $item = $this->shipmentService->get($id, ['get_product', 'warehouse']);
        $countrys = Country::get();
        return view('admin.shipment.dhl_create', compact('item', 'countrys'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dhl_order(Request $request)
    {
        $data = $request->all();
        $item = $this->shipmentService->get($data['id'], ['get_product']);
        $url = 'https://api-sandbox.dhl.com/parcel/de/shipping/v2/orders';
        $shipmentData = [
            'profile' => 'STANDARD_GRUPPENPROFIL',
            'shipments' => [
                [
                    'product' => 'V01PAK',
                    'billingNumber' => '33333333330102',
                    'refNo' => 'Order No.' . $item->invoice_number,
                    'shipper' => [
                        'name1' => $item->warehouse->name,
                        'addressStreet' => $data['street'],
                        'additionalAddressInformation1' => $data['additional'],
                        'postalCode' => $data['post_code'],
                        'city' =>  $data['city'],
                        'country' =>  'DEU',
                        'phone' => $data['phone'],
                    ],
                    'consignee' => [
                        'name1' => $item->warehouse->name,
                        'addressStreet' => $data['warehouse_street'],
                        'additionalAddressInformation1' => $data['warehouse_additional'],
                        'postalCode' => $data['warehouse_post_code'],
                        'city' =>  $data['city'],
                        'country' =>  'DEU',
                        'phone' => $data['warehouse_phone'],
                    ],
                    'details' => [
                        'dim' => [
                            'uom' => 'mm',
                            'height' => 100,
                            'length' => 200,
                            'width' => 150,
                        ],
                        'weight' => [
                            'uom' => 'g',
                            'value' => 500,
                        ],
                    ],
                ],
            ],
        ];
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic c2FuZHlfc2FuZGJveDpwYXNz',
                'Accept'        => '/',
                'dhl-api-key'   => $this->apiKey
            ])->post($url, $shipmentData);
            $responseData = json_decode($response->getBody(), true);
            if ($response->getStatusCode() === 200) {
                $base64Label = $responseData['items'][0]['label']['b64'];
                $pdfContent = base64_decode($base64Label);
                // For example, save it to a file
                $uniqueFilename = 'dhl_label_' . time() . '_' . uniqid() . '.pdf';
                // Construct the full file path
                $pdfFilePath = storage_path('app/public/dhl/' . $uniqueFilename);
                file_put_contents($pdfFilePath, $pdfContent);
                $item->update([
                    'dhl_status' => 'complete',
                    'dhl_order' => $uniqueFilename,
                ]);
                $notify[] = ['success', 'DHL Order Create successful'];
                return redirect()->route('admin.shipment.index')->withNotify($notify);
            } else {
                $validationMessages = [];
                if (isset($responseData['items'])) {
                    foreach ($responseData['items'] as $item) {
                        if (isset($item['validationMessages'])) {
                            foreach ($item['validationMessages'] as $validationMessage) {
                                $validationMessages[] = $validationMessage['validationMessage'];
                            }
                        }
                    }
                    // $notify[] = ['error', $validationMessages];
                    // dd($validationMessages);
                    return redirect()->back()->withErrors($validationMessages);
                }
            }
        } catch (\Exception $e) {
            // Handle Guzzle or other exceptions
            return ['error' => $e->getMessage()];
        }
    }
    public function change_status($id, $status)
    {
        $data['status'] = $status;
        $shipment = $this->shipmentService->get($id, ['get_product']);
        $this->shipmentService->storeOrUpdate($data, $id);
        if ($status == Shipment::SENT_STATUS) {
            $stocks = $this->stockUpdate($shipment);
            if ($stocks) {
                $notify[] = ['success', 'Shipment Update successful'];
                $offerData = [
                    'title' => 'Shipment Complete',
                    'msg' => 'Admin has complete your shipment',
                    'body' => 'Shipment Complete',
                    'url' => route('company.shipment.show', $shipment->id),
                ];
                $shipments = Shipment::findOrFail($id);
                $user = User::findOrFail($shipments->created_by);
                $user->notify(new ProductDeliveryNotification($offerData));
                return redirect()->route('admin.shipment.index')->withNotify($notify);
            } else {
                $notify[] = ['warning', 'Sorry! Stock is not available'];
                return redirect()->route('admin.shipment.index')->withNotify($notify);
            }
        } elseif ($status == Shipment::RETURN_STATUS) {
            $stocks = $this->stockUpdate($shipment, false);
            if ($stocks) {
                $notify[] = ['success', 'Shipment Update successful'];
                $offerData = [
                    'title' => 'Return Shipment Complete',
                    'msg' => 'Admin has accept your return shipment reqest',
                    'body' => 'Return Shipment Complete',
                    'url' => route('company.shipment.show', $shipment->id),
                ];
                $shipments = Shipment::findOrFail($id);
                $user = User::findOrFail($shipments->created_by);
                $user->notify(new ProductDeliveryNotification($offerData));

                return redirect()->route('admin.shipment.index')->withNotify($notify);
            } else {
                $notify[] = ['warning', 'Sorry! Stock is not available'];
                return redirect()->route('admin.shipment.index')->withNotify($notify);
            }
        } else {
            $shipment->status = $status;
            $shipment->save();
        }

        return redirect()->route('admin.shipment.index');
    }

    public function stockUpdate($shipment, $returnAble = true)
    {
        $shipmentsProducts = $shipment->get_product;
        if ($shipmentsProducts->count() > 0) {
            foreach ($shipmentsProducts as $key => $shipmentProduct) {
                $productStock = ProductStock::where('product_id', $shipmentProduct->product_id)->where('warehouse_id', $shipment->warehouse_id)->where('bundle_id', '=', null)->first();

                if (!$productStock) {
                    $productStock = ProductStock::where('bundle_id', $shipmentProduct->bundle_id)->where('warehouse_id', $shipment->warehouse_id)->where('product_id', '=', null)->first();
                }
                // Stock product quantity update
                if ($productStock && $returnAble) {
                    $productStock->stock = $productStock->stock - $shipmentProduct->quantity;
                    $productStock->save();
                } elseif ($productStock && !$returnAble) {
                    $productStock->stock = $productStock->stock + $shipmentProduct->quantity;
                    $productStock->save();
                }
            }
            return true;
        }
        return false;
    }

    public function returnList(ShipmentReturnDataTable $dataTable)
    {
        setbreadcumb("Shipment Return", "Shipment");
        return $dataTable->render('admin.shipment.returns');
    }
}
