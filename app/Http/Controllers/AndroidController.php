<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Androidapi;
use App\Http\Resources\Android;
use App\Transaction;
class AndroidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexx()
    {
        return view('home');
    }

     public function index()
    {
        $android=Androidapi::paginate(15);
        return Android::collection($android);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
	$id=$request->id;
        $transact=Transaction::whereReference($id)->first();
        if($transact)
        {
            if($transact->status==0)
            {
                $transact->status=1;
                $transact->save();
                return response()->json([
                    "status"=>201,
                    "message"=>"licence_key verified",
		    "licence"=>$request->id
                ]);
            }
            return response()->json([
                "status"=>405,
                "message"=>"licence_key already used"
            ]);

        }   
        return response()->json([
            "status"=>404,
            "message"=>"licence_key not found"
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
