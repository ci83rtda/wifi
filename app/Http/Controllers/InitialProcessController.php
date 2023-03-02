<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\ConnectionRequest;
use App\Models\User;
use App\Models\Voucher;
use App\Rules\AcceptTermsRule;
use App\Rules\ValidateCodeRule;
use App\Rules\ValidateColombiaMobilePhoneNumberRule;
use Illuminate\Http\Request;
use UniFi_API\Client;

class InitialProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function start(Request $request)
    {
        //        [
//            "ap" => "f4:92:bf:c6:f9:31",
//            "id" => "46:41:da:fc:26:36",
//            "t" => "1673814407",
//            "url" => "http://www.msftconnecttest.com/redirect",
//            "ssid" => "Wifii"
//        ];

        //wifi collect data and the send to the form
        if (session('sessionConnected', false)){
            return redirect(route('wifi.connected'));
        }

        if (session('sessionVerified', false)){
            return redirect(route('access.show_code'));
        }

        $validated = $request->validate([
            'id' => ['required','mac_address'],
            'ap' => ['required','mac_address'],
            't' => ['required','integer'],
            'ssid' => ['required','string']
        ]);


        if (!session('sessionCode',false)){

            while (true){
                $sessionCode = generateEasyToRememberNumber();
                if (!Voucher::where('code', $sessionCode)->count()){
                    break;
                }
            }
            session(['sessionCode' => $sessionCode]);

            $ConnectionRequest = ConnectionRequest::create([
                'device_mac' => $validated['id'],
                'ap_mac' => $validated['ap'],
                'ssid' => $validated['ssid'],
                'useragent' => $request->header('user-agent'),
                'ip' => $request->getClientIp(),
                'code' => $sessionCode,
            ]);

            session(['sessionRequestUuid' => $ConnectionRequest->uuid]);

        }

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
        //
    }

    /**
     * Verify if the user phone number has been registered already.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify(Request $request)
    {
        $validated = $request->validate([
            'phone' => ['required',new ValidateColombiaMobilePhoneNumberRule()],
            'accept' => ['accepted'],
        ]);
        $user = User::where('phone', $validated['phone'])->first();
        if (!is_null($user)){
            $ConnectionRequest = ConnectionRequest::find(session('sessionRequestUuid'));
            $ConnectionRequest->update(['user_id' => $user->id,'verified' => 1]);
            session(['sessionVerified' => true]);
            return redirect(route('access.show_code'));
        }
        return redirect(route('access.register'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showCode()
    {
        return view('verifiedShowCodeForAgent');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function register()
    {
        return view('registration');
    }

    /**
     * Store the newly created user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => ['required','string'],
            'lastname' => ['required','string'],
            'email' => ['required','email'],
            'phone' => ['required',new ValidateColombiaMobilePhoneNumberRule()],
            'identity_type' => ['required','integer','in:1,2,3,4,5'],
            'identity_number' => ['required','string'],
            'accept' => ['accepted'],
        ]);
        unset($validated['accept']);
        $user = User::create($validated);

        $ConnectionRequest = ConnectionRequest::find(session('sessionRequestUuid'));

        $ConnectionRequest->update(['user_id' => $user->id,'verified' => 1]);

        session(['sessionVerified' => true]);

        return redirect(route('access.show_code'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function connect(Request $request)
    {
//        $sessionThrottleRequests = session('sessionThrottleRequests',0);
//        session(['sessionThrottleRequests' => $sessionThrottleRequests++ ]);
//
//        if (session('sessionThrottleRequests', 0) >= 3){
//            return redirect(route('access.show_code'))->withErrors(['Por favor espere 1 minuto para intentar de nuevo']);
//        }

        if (!session('sessionVerified', false)){
            return redirect(route('wifi.form'));
        }

        if (session('connected', false)){
            return redirect(route('wifi.connected'));
        }

        $ConnectionRequest = ConnectionRequest::findOrFail(session('sessionRequestUuid'));

        $voucher = Voucher::where('code', $ConnectionRequest->code)->first();

        if (is_null($voucher)){
            return redirect(route('access.show_code'))->withErrors(['Su compra aun no ha sido procesada']);
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
            return view('connected');
        }

        return redirect(route('access.show_code'));


    }
}
