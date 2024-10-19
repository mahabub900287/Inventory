<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.pages.home');
    }
    public function markAsRead($id)
    {
        $user = Auth::user();
        $user->unreadNotifications->where('id', $id)->markAsRead();
        return response()->json(true);
    }
    public function markAsReadAll()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
