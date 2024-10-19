<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\AdminDeliveryDataTable;
use App\Services\Company\Product\ProductService;
use App\Notifications\ProductDeliveryNotification;
use App\Services\Company\Delivery\DeliveryService;

class DeliveryController extends Controller
{
    protected $deliveryService;
    protected $productService;
    public function __construct(DeliveryService $deliveryService, ProductService $productService)
    {
        $this->deliveryService = $deliveryService;
        $this->productService = $productService;

        $this->middleware('permission:All Delivery|Create Delivery|Edit Delivery|Delete Delivery', ['only' => ['index', 'store']]);
        $this->middleware('permission:Create Delivery', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Delivery', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Show Delivery', ['only' => ['show']]);
        $this->middleware('permission:Delete Delivery', ['only' => ['destroy']]);
    }


    public function index(AdminDeliveryDataTable $dataTable)
    {
        setbreadcumb("Delivery List", "Delivery");
        return $dataTable->render('admin.delivery.index');
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
        setbreadcumb("Delivery Show", "Delivery");
        $delivery = $this->deliveryService->get($id, ['deliveryProducts.products']);
        return view('admin.delivery.show', compact('delivery'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function change_status($id, $status)
    {

        // try {
        $stockUpdate = $this->deliveryService->change_status($id, $status);
        if ($stockUpdate) {
            $notify[] = ['success', 'Delivery Status Update successfully'];
            $offerData = [
                'title' => 'Delivery Status',
                'msg' => 'Admin' . ' ' . $status . ' the delivery product',
                'body' => 'Admin change the delivery status',
                'url' => route('company.delivery.show', $id),
            ];
            $delivery = Delivery::findOrFail($id);
            $user = User::findOrFail($delivery->created_by);
            $user->notify(new ProductDeliveryNotification($offerData));

            return redirect()->route('admin.delivery.index')->withNotify($notify);
        } else {
            $notify[] = ['error', 'Delivery Status Update failed'];
            return redirect()->route('admin.delivery.index')->withNotify($notify);
        }
        // } catch (\Throwable $th) {
        //     $notify[] = ['error', 'Something went wrong'];
        //     return redirect()->route('admin.delivery.index')->withNotify($notify);
        // }
    }
}
