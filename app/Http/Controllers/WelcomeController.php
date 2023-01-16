<?php

namespace App\Http\Controllers;

use App\Rules\ValidateTimeZoneRule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use mysql_xdevapi\Exception;
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
        //wifi collect data and the send to the form
        if (session('connected', false)){
            return redirect(route('wifi.connected'));
        }
        if (!session('session_id',false)){
            session(['session_id' => Str::ulid()]);
        }
        $validated = $request->validate([
            'id' => ['required','mac_address'],
            'ap' => ['required','mac_address'],
            't' => ['required'],
        ]);
        session([
            'ap' => $validated['ap'],
            'id' => $validated['id'],
            'ts' => $validated['t'],
        ]);
        return redirect(route('wifi.form'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //wifi form show
        return view('welcome');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'code' => ['required'],
            'accept' => ['accepted'],
        ]);

        if ($validated['code'] != '9025'){
            return redirect(route('wifi.form'));
        }

        $mac = session('id');

        /**
         * the MAC address of the Access Point the guest is currently connected to, enter null (without quotes)
         * if not known or unavailable
         *
         * NOTE:
         * although the AP MAC address is not a required parameter for the authorize_guest() function,
         * adding this parameter will speed up the initial authorization process
         */
        $ap_mac = session('ap');

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
        $auth_result = $unifi_connection->authorize_guest($mac, $duration, 1000, 3000, null, $ap_mac);
        if ($auth_result){
            session(['connected' => true]);
            return redirect(route('wifi.connected'));
        }

        return redirect(route('wifi.form'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        dd('Estas conectado');
    }

    public function error()
    {
        dd('error');
    }

}
