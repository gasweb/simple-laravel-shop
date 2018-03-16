<?php
namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;

class ContentController extends Controller
{
    /**
     * Main page action
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('public.main.index');
    }
}