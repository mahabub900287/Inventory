<?php

namespace App\Http\Controllers\Admin\New;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AccountSuspended;
use App\Http\Controllers\Controller;
use App\Services\Common\UserService;
use Illuminate\Support\Facades\Mail;
use App\DataTables\Admin\AdminDataTable;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Common\ProfileRequest;
use App\Services\Utilities\FileUploadService;

class AdminController extends Controller
{
    protected $userservice;

    protected $fileUploadService;

    public function __construct(UserService $userservice, FileUploadService $fileUploadService)
    {
        $this->userservice = $userservice;
        $this->fileUploadService = $fileUploadService;

        $this->middleware('permission:All Admins|Create Admin|Edit Admin|Delete Admin', ['only' => ['index', 'store']]);
        $this->middleware('permission:Create Admin', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit Admin', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Delete Admin', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDataTable $dataTable)
    {
        $page_title = 'Admin list';
        setbreadcumb("Admin list", "Admin");
        return $dataTable->render('admin.admin.new-admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        setbreadcumb("Admin Create", "Admin");
        $roles = \Spatie\Permission\Models\Role::select('id', 'name')->get();
        return view('admin.admin.new-admin.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        $data = $request->validated();
        // try {
        isset($data['status']) ? $data['status'] = 'active' : $data['status'] = 'inactive';
        $data['type']  = 'admin';
        $this->userservice->storeOrUpdate($data);
        $notify[] = ['success', 'Admin Create successful'];
        return redirect()->route('admin.new-admin.index')->withNotify($notify);
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
        setbreadcumb("Show Admin", "Admin");
        $item = User::find($id);
        return view('admin.admin.new-admin.shows', compact('item'));
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
            $item = $this->userservice->get($id);
            $roles = \Spatie\Permission\Models\Role::select('id', 'name')->get();
            setbreadcumb("Admin Edit", "Admin");
            // $roles = \Spatie\Permission\Models\Role::select('id', 'name')->get();
            return view('admin.admin.new-admin.edit', compact('item', 'roles'));
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
    public function update(ProfileRequest $request, $id)
    {
        $data = $request->validated();
        // try {
        isset($data['status']) ? $data['status'] = 'active' : $data['status'] = 'inactive';
        $data['type']  = 'admin';
        $this->userservice->storeOrUpdate($data, $id);
        $notify[] = ['success', 'Admin Update successful'];

        return redirect()->route('admin.new-admin.index')->withNotify($notify);
        // } catch (\Exception $e) {

        //     return back();
        // }
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
            $item = User::find($id);
            if ($item->avatar !== null) {
                $this->fileUploadService->delete('user/' . $item->avatar);
            }
            $item->delete();
            $notify[] = ['success', 'User Delete successfully'];

            return redirect()->route('admin.users.index')->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }

    public function bulk_action(Request $request)
    {
        try {
            $item = User::whereIn('id', $request->ids)->get();
            if ($item->count() > 0) {
                User::whereIn('id', $request->ids)->delete();
                return response()->json(['status' => 'ok']);
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
