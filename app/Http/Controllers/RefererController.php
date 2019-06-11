<?php

namespace App\Http\Controllers;

use App\Referer;
use App\Transaction;
use Illuminate\Http\Request;
use Str;
class RefererController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $referers=Referer::all();
        return view('admin.index',compact("referers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.register');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            "name"=>"required",
            "school"=>"required",
            "department"=>"required",
            "email"=>"required|email|unique:referers",
            "account_number"=>"required|min:10",
            "bank"=>"required"
        ]);
        // dd($request->all());
        $referer= new Referer;
        $referer->name=$request->name;
        $referer->school=$request->school;
        $referer->department=$request->department;
        $referer->email=$request->email;
        $referer->bank=$request->bank;
        $referer->account_number=$request->account_number;
        $t=time();
        
        // dd($referer->code);
        if($referer->save())
        {
            $referer->code= str_slug($request->name)."-{$referer->id}";
            if($referer->save()){
                return redirect()->back()->with("status","User successfully added");
            }
            
        }
    }
    public function Allusers()
    {
        $referers=Referer::all();
        return view('admin.allusers',compact('referers'));
    }
    public function transact()
    {
        $transactions=Transaction::all();
        return view('admin.transaction',compact('transactions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
}
