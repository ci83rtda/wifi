<?php

namespace App\Http\Controllers;

use App\Rules\ValidateTimeZoneRule;
use Illuminate\Http\Request;
use UniFi_API\Client;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $validated = $request->validate([
            'id' => ['required','mac_address'],
            'ap' => ['required','mac_address'],
            't' => ['required']

        ]);

        $mac = $validated['id'];

        /**
         * the MAC address of the Access Point the guest is currently connected to, enter null (without quotes)
         * if not known or unavailable
         *
         * NOTE:
         * although the AP MAC address is not a required parameter for the authorize_guest() function,
         * adding this parameter will speed up the initial authorization process
         */
        $ap_mac = $validated['ap'];

        /**
         * the duration to authorize the device for in minutes
         */
        $duration = 1440;

        /**
         * The site to authorize the device with
         */
        $site_id = 'default';


        $unifi_connection = new Client(config('services.unifi_controller.username'), config('services.unifi_controller.password'), config('services.unifi_controller.url'), $site_id, config('services.unifi_controller.version'));
        $set_debug_mode   = $unifi_connection->set_debug(false);
        $loginresults     = $unifi_connection->login();

        /**
         * then we authorize the device for the requested duration
         */
        $auth_result = $unifi_connection->authorize_guest($mac, $duration, null, null, null, $ap_mac);

        dd($auth_result);
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
