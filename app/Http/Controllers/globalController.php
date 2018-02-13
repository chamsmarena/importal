<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class globalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function getFTSdata($endpoint) {
		// $fts_username = "ocha_dakar";
		// $fts_password = "thnm456Ujm";
		$fts_username = "ocha_viu";
		$fts_password = "nbgt876Sxc";
	
		// curl init	
		$ch = curl_init();
		$uri = "https://api.hpc.tools/v1/public/".$endpoint;
		//curl opts
		curl_setopt($ch, CURLOPT_CAINFO,app_path()."/certificates/cacert-2017-09-20.pem");
		curl_setopt($ch, CURLOPT_URL,$uri);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD, "$fts_username:$fts_password");
		
		//process results
		$result = curl_exec($ch);
		

		
		if($result === false)
		{
			echo 'Erreur Curl : ' . curl_error($ch);
			$result = null;
		}
		else
		{
			$result;
			
		}
		curl_close($ch);

		return $result;
    }

    public function dashboard()
    {
        $users = DB::select('select * from admin_0 where ID_A0 = ?', [1]);

    
        return $users;
    }

    
}
