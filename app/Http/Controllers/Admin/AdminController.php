<?php

namespace Qwikkar\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Qwikkar\Http\Controllers\Controller;

class AdminController extends Controller
{
    /**
     * Show the application's admin dashboard.
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return view('admin.index');
    }
}
