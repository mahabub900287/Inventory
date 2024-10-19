<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\AdminService;
use App\DataTables\Admin\UserDataTable;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Common\ProfileRequest;
use App\Services\Common\UserService;
use App\Services\Utilities\FileUploadService;

class UserController extends Controller
{
    protected $userservice;

    protected $fileUploadService;

    public function __construct(UserService $userservice, FileUploadService $fileUploadService)
    {
        $this->userservice = $userservice;
        $this->fileUploadService = $fileUploadService;

        $this->middleware('permission:All Users|Create User|Edit User|Delete User', ['only' => ['index', 'store']]);
        $this->middleware('permission:Create User', ['only' => ['create', 'store']]);
        $this->middleware('permission:Edit User', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Show User', ['only' => ['show']]);
        $this->middleware('permission:Delete User', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {
        setbreadcumb("Users List", "Users");
        return $dataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        setbreadcumb("Users Create", "Users");
        return view('admin.users.create');
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
        try {
            isset($data['status']) ? $data['status'] = 'active' : $data['status'] = 'inactive';
            $this->userservice->storeOrUpdate($data);
            $notify[] = ['success', 'User Create successful'];
            return redirect()->route('admin.users.index')->withNotify($notify);
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
        setbreadcumb("Users Show", "Users");
        $item = User::find($id);
        return view('admin.users.shows', compact('item'));
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
            setbreadcumb("Users Edit", "Users");
            return view('admin.users.edit', compact('item'));
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
        try {
            isset($data['status']) ? $data['status'] = 'active' : $data['status'] = 'inactive';
            $this->userservice->storeOrUpdate($data, $id);
            $notify[] = ['success', 'User Update successful'];

            return redirect()->route('admin.users.index')->withNotify($notify);
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
