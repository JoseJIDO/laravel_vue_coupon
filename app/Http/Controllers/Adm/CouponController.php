<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    /**
    * Render view page.
    * @return Illuminate\Support\Facades\Blade
    */
    public function index()
    {
        return view('adm.index');
    }
}
