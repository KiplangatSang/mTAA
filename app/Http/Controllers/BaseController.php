<?php

namespace App\Http\Controllers;

use App\Models\CountriesList;
use App\Employees\Employees;
use App\Helpers\Billing\PaymentGatewayContract;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Landlord\PlotSessionController;
use App\Http\Controllers\Retailer\Transactions\TransactionController;
use App\Models\User;
use App\Repositories\AppRepository;
use App\Repositories\FirebaseRepository;
use App\Retails\Retail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{
    //

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */

    //gets retails list sent to home controller for choosing

    public function housePagination()
    {
        # code...
        $housePagination = 20;
        return $housePagination;
    }

    public function formatPhoneNumber($code, $phone_number)
    {
        # code...
        $phoneNo = null;
        if (strlen($phone_number)  == 9) {
            $phoneNo = '254' . $phone_number;
        } else if (strlen($phone_number)  == 10) {
            $phone_number =  trim($phone_number, "0");
            $phoneNo = $code . $phone_number;
        } else {
            return $phoneNo;
        }
        return $phone_number;
    }
    public function user()
    {
        $user = User::where('id', auth()->id())
            ->first();
        return $user;
    }

    public function admin()
    {
        $admin = User::where('id', 1)
            ->with('accounts')
            ->first();
        return $admin;
    }


    public function appRepository()
    {
        # code...
        $baseRepo = new AppRepository();
        return $baseRepo;
    }

    public function getBaseImages()
    {
        # code...
        $baseImages = $this->appRepository()->getBaseImages();
        return $baseImages;
    }
    public function getRetailList()
    {
        $user = User::where('id', Auth::id())->first();

        if ($user->is_owner) {
            $retails = null;
            # code...
            $retails = $user->retails()->get();
            $retailList['retails'] = $retails;

            return $retailList;
        } elseif (!$user->is_owner && $user->is_employee) {
            // dd($user);

            $employeeaccount = $user->employees()->first();
            $retails = null;
            # code...
            $retails =  $employeeaccount->employeeable()->get();
            $retailList['retails'] = $retails;
            return $retailList;
        } else {
            dd("employeeaccount");
        }
    }

    public function setRetail()
    {

        $retails = $this->getRetailList();

        if (count($retails['retails']) < 1) {
            return redirect("/client/retails/create")->with('error', 'Register Your Retail Shop First');
        }


        return view('retails', compact('retails'));
    }


    public function plotsession()
    {
        $sessioncontroller = new PlotSessionController();
        $plot =  $sessioncontroller->show();

        if (!$plot)
            return false;

        return $plot;
    }




    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    function calculate_profile($profile)
    {
        if (!$profile) {
            return 0;
        }
        $columns    = preg_grep('/(.+ed_at)|(.*id)/', array_keys($profile->toArray()), PREG_GREP_INVERT);
        $per_column = 100 / count($columns);
        $total      = 0;

        foreach ($profile->toArray() as $key => $value) {
            if ($value !== NULL && $value !== [] && in_array($key, $columns)) {
                $total += $per_column;
            }
        }
        $total = number_format($total, 2);
        return $total;
    }

    public function saveFile($folder, $file)
    {
        # code...

        $user = $this->user();

        $fileNameToStore = "";

        $plotsession = $this->plotsession();

        if (!$plotsession) {
            $firebase = new FirebaseRepository();
            $fileNameToStore =  $firebase->store($user, $folder, $file);
        } else {
            $firebase = new FirebaseRepository($plotsession);
            $fileNameToStore =  $firebase->store($user, $folder, $file);
        }
        info($fileNameToStore);
        return $fileNameToStore;
    }




    public function location()
    {
        # code...
        $apprepo = new AppRepository();
        $location = (array)$apprepo->getLocation();
        // dd($location);
        return $location;
    }

    public function getLocationDetails()
    {
        # code...
        $region = $this->location();
        // dd($region);
        if (count($region) < 2)
            $region = array(
                "ip" => "unknown",
                "countryName" => "Kenya",
                "countryCode" => "KE",
                "regionCode" => "30",
                "regionName" => "Nairobi Province",
                "cityName" => "Nairobi",
                "zipCode" => null,
                "isoCode" => null,
                "postalCode" => null,
                "latitude" => "-1.2841",
                "longitude" => "36.8155",
                "metroCode" => null,
                "areaCode" => "",
                "timezone" => "Africa/Nairobi",
                "driver" => "Stevebauman\Location\Drivers\GeoPlugin",
            );

        $phoneCode = CountriesList::where('iso', $region['countryCode'])->first()->phonecode;
        $region['phoneCode'] = $phoneCode;
        $region['countries'] = CountriesList::all();
        return $region;
    }

    // public function getTransactionType($gateway)
    // {
    //     # code...
    //     $transaction_type = null;
    //     if($gateway == "DUKAVERSE"){
    //         if($)
    //         $transaction_type = 1;
    //     }else{
    //         $transaction_type = 3;
    //     }

    //     return $transaction_type;
    // }

    // public function saveTransaction(
    //     $gateway,
    //     $sender_account_id,
    //     $receiver_account_id,
    //     $sender_phone_number,
    //     $receiver_phone_number,
    //     $amount,
    //     $transaction_type,
    //     $cost,
    //     $currency,
    //     $purpose,
    //     $message,
    //     $purpose_id = null
    // ) {
    //     # code...

    //     $requestdata = array(
    //         "gateway" => $gateway,
    //         'sender_account_id' => $sender_account_id,
    //         'receiver_account_id' => $receiver_account_id,
    //         'sender_phone_number' => $sender_phone_number,
    //         'receiver_phone_number' => $receiver_phone_number,
    //         "amount" => $amount,
    //         "transaction_type" => $transaction_type,
    //         "cost" => $cost,
    //         "currency" => $currency,
    //         "purpose" => $purpose,
    //         "message" => $message,
    //         "purpose_id" => $purpose_id
    //     );


    //     $request = new Request();
    //     $request->setMethod('POST');
    //     $request->request->add($requestdata);

    //     $transactionController = new TransactionController();
    //     $result =  $transactionController->store($request);


    //     if (!$result)
    //         return false;


    //     return $result;
    // }

    // public function createAccount($accountType, $account)
    // {
    //     # code...

    //     $requestdata = array(
    //         'accountType' =>  $accountType,
    //         'account' => $account,
    //     );

    //     $request = new Request();
    //     $request->setMethod('POST');
    //     $request->request->add($requestdata);
    //     $accountController = new AccountController();
    //     $result =  $accountController->store($request);

    //     return $result;
    // }
}
