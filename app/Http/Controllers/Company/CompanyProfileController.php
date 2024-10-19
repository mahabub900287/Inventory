<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Common\UserService;
use App\Http\Requests\Common\ProfileRequest;

class CompanyProfileController extends Controller
{
    protected $userservice;

    public function __construct(UserService $userservice)
    {
        $this->userservice = $userservice;
    }
    public function profileEdit($id)
    {
        setbreadcumb("Company Profile", "Administration");
        return view('company.profile.edit');
    }
    public function profileupdate(ProfileRequest $request, $id)
    {
        $data = $request->validated();
        try {
            $this->userservice->storeOrUpdate($data, $id);
            $notify[] = ['success', 'Admin Profile Update successful'];
            return redirect()->back()->withNotify($notify);
        } catch (\Exception $e) {
            return back();
        }
    }
}
