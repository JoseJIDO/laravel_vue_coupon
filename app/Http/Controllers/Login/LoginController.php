<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Services\LoginService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    /**
     * The service for consume the login JIDO
     * @var LoginService
     */
    public $loginService;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Render view page.
     * @return Illuminate\Support\Facades\Blade
     */
    public function index()
    {
        return view('login.login');
    }

    /**
     * @param Request user
     * @param Request password
     */
    public function login(Request $request)
    {
       //$data = $this->loginService->login($request->all());

       return redirect()->route('adm');
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        return redirect()->route('login.view');
    }
}
