<?php

namespace App\Http\Controllers;

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
        //header("Content-Type:application/json");
        /* if (!isset($_GET["token"])) {
        echo "Technical error";
        exit();
        }
        if ($_GET["token"] != '4HWjtR6B2UT4') {

        echo "Invalid authorization";
        exit();
        } */

        /* Takes raw data from the request */
        //$json = file_get_contents('php://input');

        /* Converts it into a PHP object */
        //$data = json_decode($json);

        /* $fname = $data->first_name;
        $lname = $data->last_name;
        $amount = $data->amount;
        $reference = $data->transaction_reference;
        $sender_phone = $data->sender_phone;
        $middle_name = $data->middle_name;
        $service_name = $data->service_name;
        $business_number = $data->business_number;
        $internal_transaction_id = $data->internal_transaction_id;
        $transaction_timestamp = $data->transaction_timestamp;
        $transaction_type = $data->transaction_type;
        $account_number = $data->account_number;
        $currency = $data->currency;
        $signature = $data->signature; */

        /* Create new post */
        /* $kopokopo = new Kopokopo;
        $kopokopo->sender_phone = $data->sender_phone;
        $kopokopo->reference = $data->transaction_reference;
        $kopokopo->amount = $data->amount;
        $kopokopo->last_name = $data->last_name;
        $kopokopo->first_name = $data->first_name;
        $kopokopo->middle_name = $data->middle_name;
        $kopokopo->service_name = $data->service_name;
        $kopokopo->business_number = $data->business_number;
        $kopokopo->internal_transaction_id = $data->internal_transaction_id;
        $kopokopo->transaction_timestamp = $data->transaction_timestamp;
        $kopokopo->transaction_type = $data->transaction_type;
        $kopokopo->account_number = $data->account_number;
        $kopokopo->currency = $data->currency;
        $kopokopo->signature = $data->signature;
        $kopokopo->save(); */

        return view('/pages/kopokopo');
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
}
