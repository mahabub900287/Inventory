<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Country;
use App\Models\WareHouse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Admin\WareHouseDataTable;
use App\Services\Admin\WareHouse\WareHouseService;
use App\Http\Requests\Admin\WareHouse\WareHouseRequest;

class WareHouseController extends Controller
{
    protected $warehouseservice;

    public function __construct(WareHouseService $warehouseservice)
    {
        $this->warehouseservice = $warehouseservice;

        $this->middleware('permission:All Ware-House|Create Ware-House|Edit Ware-House|Delete Ware-House', ['only' => ['index', 'store']]);
        $this->middleware('permission:Create Ware-House', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Ware-House', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Show Ware-House', ['only' => ['show']]);
        $this->middleware('permission:Delete Ware-House', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WareHouseDataTable $dataTable)
    {
        setbreadcumb("Ware-House List", "Ware-House");
        return $dataTable->render('admin.ware-house.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        setbreadcumb("Ware-House Create", "Ware-House");
        $users = User::where('status', 'active')->where('type', 'admin')->get();
        $countrys = Country::get();
        return view('admin.ware-house.create', compact('users', 'countrys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WareHouseRequest $request)
    {
        $data = $request->validated();
        try {
            isset($data['status']) ? $data['status'] = 'active' : $data['status'] = 'inactive';
            $this->warehouseservice->storeOrUpdate($data);
            $notify[] = ['success', 'WareHouse Create successful'];
            return redirect()->route('admin.ware-house.index')->withNotify($notify);
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
            $item = $this->warehouseservice->get($id, ['user']);
            $users = User::where('status', 'active')->where('type', 'admin')->get();
            $countrys = Country::get();
            setbreadcumb("Ware-House Edit", "Ware-House");
            return view('admin.ware-house.edit', compact('item', 'users', 'countrys'));
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
    public function update(WareHouseRequest $request, $id)
    {
        $data = $request->validated();
        try {
            isset($data['status']) ? $data['status'] = 'active' : $data['status'] = 'inactive';
            $this->warehouseservice->storeOrUpdate($data, $id);
            $notify[] = ['success', 'Ware-House Update successful'];
            return redirect()->route('admin.ware-house.index')->withNotify($notify);
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
            $this->warehouseservice->delete($id);
            $notify[] = ['success', 'Ware-House delete successfully'];

            return redirect()->route('admin.ware-house.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }
    public function bulk_action(Request $request)
    {
        try {
            $item = WareHouse::whereIn('id', $request->ids)->get();
            if ($item->count() > 0) {
                WareHouse::whereIn('id', $request->ids)->delete();
                return response()->json(['status' => 'ok']);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
