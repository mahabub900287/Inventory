<?php

namespace App\Http\Controllers\Company;

use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\DataTables\Company\ProductDataTable;
use App\Services\Company\Product\BundleService;
use App\Http\Requests\Company\BundleProductRequest;
use App\Services\Company\Product\BundleProductService;

class BundleProductController extends Controller
{
    protected $bundleservice;
    protected $bundleproductservice;

    public function __construct(BundleService $bundleservice, BundleProductService $bundleproductservice)
    {
        $this->bundleservice = $bundleservice;
        $this->bundleproductservice = $bundleproductservice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable)
    {
        setbreadcumb("Product List", "Product");
        return $dataTable->render('admin.product.index');
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
    public function store(BundleProductRequest $request)
    {
        $data = $request->validated();
        try {
            $bundle = $this->bundleservice->storeOrUpdate($data);
            if ($bundle) {
                $this->bundleproductservice->storeOrUpdate($data, $bundle->id);
            }
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
            $item = $this->bundleservice->get($id, ['get_bundle_product']);
            $products = Product::where('status', 'active')->get();
            $countrys = Country::get();
            setbreadcumb("Product Bundle Edit", "Product Bundle", "products");
            return view('company.bundle.edit', compact('item', 'products', 'countrys'));
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
    public function update(BundleProductRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $bundle = $this->bundleservice->storeOrUpdate($data, $id);
            if ($bundle) {
                $this->bundleproductservice->storeOrUpdate($data, $id, $id);
            }
            $notify[] = ['success', 'Product Create successful'];
            return redirect()->route('company.product.index')->withNotify($notify);
        } catch (\Exception $e) {
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
            $this->bundleservice->delete($id);
            $notify[] = ['success', 'Product delete successfully'];
            return redirect()->route('company.product.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }
}
