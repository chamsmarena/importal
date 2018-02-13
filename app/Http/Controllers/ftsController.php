<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ftsController extends Controller
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

    public function dashboard()
    {
        
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
		
		//curl opts
		curl_setopt($ch, CURLOPT_CAINFO, asset("certificates/cacert-2017-09-20.pem"));
		curl_setopt($ch, CURLOPT_URL,$endpoint);
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
			$result = json_decode($result);
		}
		curl_close($ch);

		return $result;
    }
    
    public function getFtsFlows($endpoint) {
        
    }
    
}
