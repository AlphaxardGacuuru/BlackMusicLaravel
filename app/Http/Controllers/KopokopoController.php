<?php

namespace App\Http\Controllers;

use App\Kopokopo;
use Illuminate\Http\Request;

class KopokopoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/kopokopo');
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
        $kopokopo = new Kopokopo;
        $kopokopo->sender_phone = $request->input('sender_phone');
        $kopokopo->first_name = $request->input('first_name');
        $kopokopo->last_name = $request->input('last_name');
        $kopokopo->amount = $request->input('amount');
        $kopokopo->reference = $request->input('transaction_reference');
        $kopokopo->middle_name = $request->input('middle_name');
        $kopokopo->service_name = $request->input('service_name');
        $kopokopo->business_number = $request->input('business_number');
        $kopokopo->internal_transaction_id = $request->input('internal_transaction_id');
        $kopokopo->transaction_timestamp = $request->input('transaction_timestamp');
        $kopokopo->transaction_type = $request->input('transaction_type');
        $kopokopo->account_number = $request->input('account_number');
        $kopokopo->currency = $request->input('currency');
        $kopokopo->signature = $request->input('signature');
        $kopokopo->save();

        return response()->json([
            'status' => '01',
            'description' => 'Accepted',
            'subscriber_message' => 'Thank you John Doe for your payment of Ksh 4000. We value your business',
        ]);
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
