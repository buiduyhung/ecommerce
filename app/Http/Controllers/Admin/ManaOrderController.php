<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManaOrderController extends Controller
{
    public function index(){

        return view('admin.order.index');
    }
}