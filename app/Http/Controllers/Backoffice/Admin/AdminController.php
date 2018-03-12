<?php
namespace App\Http\Controllers\Backoffice\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request,
    Illuminate\Support\Facades\Lang;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backoffice.admin.index');
    }
}
