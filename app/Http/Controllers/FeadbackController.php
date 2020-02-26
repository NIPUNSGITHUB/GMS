<?php

namespace App\Http\Controllers;

use App\Feadback;
use DB;
use Illuminate\Http\Request;

class FeadbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $count = $request->rpp;
        return DB::table('feedback')->select('*')->orderBy('id','DESC')->paginate($count);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        
       //DB::insert('insert into users (id, name) values (?, ?)', [1, 'Dayle'])
        
       try {
        
        $feadback = new Feadback;
        $feadback->user_id = $request->user_id;
        $feadback->comment = $request->comment; 
        $result = $feadback->save();
        
        if($result)        
            return response("Success",200);

       } catch (Exception $th) {
          return $th;
       }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Feadback  $feadback
     * @return \Illuminate\Http\Response
     */
    public function show(Feadback $feadback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Feadback  $feadback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feadback $feadback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Feadback  $feadback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feadback $feadback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Feadback  $feadback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feadback $feadback)
    {
        //
    }
}
