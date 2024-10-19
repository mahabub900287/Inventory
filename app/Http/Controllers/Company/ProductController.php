<?php

namespace App\Http\Controllers\Company;

use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\DataTables\Company\ProductDataTable;
use App\Http\Requests\Company\ProductRequest;
use App\Models\Bundle;
use App\Models\BundleProduct;
use App\Services\Company\Product\ProductService;

class ProductController extends Controller
{
    protected $productservice;

    public function __construct(ProductService $productservice)
    {

        $this->productservice = $productservice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable)
    {
        setbreadcumb("Product List", "Product");
        return $dataTable->render('company.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        setbreadcumb("Product Create", "Product");
        $products = Product::where('status', 'active')->where('created_by', auth()->user()->id)->get();
        $countrys = Country::get();
        return view('company.product.create', compact('products', 'countrys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        try {
            $this->productservice->storeOrUpdate($data);
            $notify[] = ['success', 'Product Create successful'];
            return redirect()->route('company.product.index')->withNotify($notify)->withForget('active_tab');
        } catch (\Exception $e) {
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
        //
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

            $item = $this->productservice->get($id);
            if ($item->created_by == auth()->user()->id) {
                $countrys = Country::get();
                setbreadcumb("Product Edit", "Product");
                return view('company.product.edit', compact('item', 'countrys'));
            } else {
                $notify[] = ['error', 'This product is not yours product'];
                return redirect()->route('company.product.index')->withNotify($notify);
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
    public function update(ProductRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $this->productservice->storeOrUpdate($data, $id);
            $notify[] = ['success', 'Product Update successful'];
            return redirect()->route('company.product.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }

    public function status_change(Request $request)
    {
        try {
            if ($request->itemType == 'bundle') {
                $item = Bundle::findOrFail($request->productId);
            } else {
                $item = Product::findOrFail($request->productId);
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->productservice->delete($id);
            $notify[] = ['success', 'Product delete successfully'];
            return redirect()->route('company.product.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }
    public function csv_product()
    {
        setbreadcumb("Product Create Csv", "Product");
        return view('company.product.csv');
    }
    public function csv_store(Request $request)
    {
        $data = $request->all();
        try {
            $this->productservice->excelUpload($data);
            $notify[] = ['success', 'Product Update successful'];
            return redirect()->route('company.product.index')->withNotify($notify);
        } catch (\Exception $e) {
            $notify[] = ['error', $e];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function bulk_action(Request $request)
    {
        try {
            $item = Product::whereIn('id', $request->ids)->whereIn('item_type', $request->types)->get();
            $bundle = Bundle::whereIn('id', $request->ids)->whereIn('item_type', $request->types)->get();
            if ($item->count() > 0) {
                Product::whereIn('id', $request->ids)->delete();
            }
            if ($bundle->count() > 0) {
                Bundle::whereIn('id', $request->ids)->delete();
            }
            return response()->json(['status' => 'ok']);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
