<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $CountMyOrder = order::where('user_id', Auth::id())->count();
        $CountOrderPending = order::where(['user_id' => Auth::id(), 'status' => 3])->count();
        $CountOrderSuccess = order::where(['user_id' => Auth::id(), 'status' => 1])->count();

        return view('index', compact('CountMyOrder', 'CountOrderPending', 'CountOrderSuccess'));
    }
    
}
