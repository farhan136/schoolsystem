<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function dologin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dologout(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }

    public function home()
    {
        return view('admin.home');
    }

    public function getcity(Request $request)
    {
        $Cities = DB::table('cities')
            ->select('city_id', 'city_name')
            ->orderBy('city_id', 'asc')
            ->where('prov_id', $request->id)
            ->get();
        echo json_encode($Cities);
    }

    public function getdistrict(Request $request)
    {
        $Districts = DB::table('districts')
            ->select('dis_id', 'dis_name')
            ->orderBy('dis_id', 'asc')
            ->where('city_id', $request->id)
            ->get();
        
        echo json_encode($Districts);
    }

    public function getsubdistrict(Request $request)
    {
        $Subdistricts = DB::table('subdistricts')
            ->select('subdis_id', 'subdis_name')
            ->orderBy('subdis_id', 'asc')
            ->where('dis_id', $request->id)
            ->get();
        echo json_encode($Subdistricts);
    }

}
