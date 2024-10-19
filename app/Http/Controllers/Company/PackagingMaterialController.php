<?php

namespace App\Http\Controllers\Company;

use App\DataTables\Company\PackagingMaterialDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Company\PackagingRequest;
use App\Models\PackagingMaterial;
use App\Services\Company\Product\PackagingService;
use Illuminate\Http\Request;

class PackagingMaterialController extends Controller
{
    protected $packagingservice;

    public function __construct(PackagingService $packagingservice)
    {
        $this->packagingservice = $packagingservice;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PackagingMaterialDataTable $dataTable)
    {
        setbreadcumb("Packaging Material List", "Packaging Material");
        return $dataTable->render('company.packaging.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        setbreadcumb("Packaging Material Create", "Packaging Material");
        return view('company.packaging.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackagingRequest $request)
    {
        $data = $request->validated();
        // try {
        $this->packagingservice->storeOrUpdate($data);
        $notify[] = ['success', 'Packaging Material Create successful'];
        return redirect()->route('company.packaging.index')->withNotify($notify);
        // } catch (\Exception $e) {
        // }
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
            $item = $this->packagingservice->get($id);
            setbreadcumb("Packaging Material Edit", "Packaging Material");
            return view('company.packaging.edit', compact('item'));
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
    public function update(PackagingRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $this->packagingservice->storeOrUpdate($data, $id);
            $notify[] = ['success', 'Packaging Material successful'];
            return redirect()->route('company.packaging.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
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
            $this->packagingservice->delete($id);
            $notify[] = ['success', 'Packaging Material delete successfully'];
            return redirect()->route('company.packaging.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }
    public function status_change(Request $request)
    {
        try {

            $item = PackagingMaterial::findOrFail($request->productId);
            $status = $item->status == 'active' ? 'inactive' : 'active';
            $item->update([
                'status' => $status,
            ]);
            return response()->json(['success' => true, 'updatedStatus' => $status, 'productId' => $request->productId]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
    public function bulk_action(Request $request)
    {
        try {
            $item = PackagingMaterial::whereIn('id', $request->ids)->get();
            if ($item->count() > 0) {
                PackagingMaterial::whereIn('id', $request->ids)->delete();
                return response()->json(['status' => 'ok']);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
