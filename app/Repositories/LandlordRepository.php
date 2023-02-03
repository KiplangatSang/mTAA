<?php

namespace App\Repositories;

use App\LoanApplication;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
use App\Models\CountriesList;
use App\Models\KenyaCounties;
use App\Models\Plots\Houses;
use App\Repositories\EmployeesRepository;
use App\Repositories\ExpenseRepository;
use App\Repositories\LoansRepository;
use App\Repositories\OrdersRepository;
use App\Repositories\ProfitRepository;
use App\Repositories\RequiredItemsRepository;
use App\Repositories\RevenueRepository;
use App\Repositories\SalesRepository;
use App\Repositories\StockRepository;
use App\Repositories\SuppliesRepository;
use App\Retails\SessionRetail;
use Exception;
use Illuminate\Support\Facades\DB;
use Stevebauman\Location\Facades\Location;

class LandlordRepository
{
    //get ip address
    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $_SERVER;
                    }
                }
            } else {
                return "unknown";
            }
        }
    }
    public function getLocation()
    {
        # code...

        $currentUserInfo = Location::get($this->getIp());
        return  $currentUserInfo;
    }
    public function getBaseImages()
    {

        $images = array(
            "noprofile" => "https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png",
            "nofile" => "https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/nofile.png",
        );
        return $images;
    }

    public function getRegisteredMonths()
    {
        # code...
        $registrationmonths = User::distinct('month')->orderBy('month', 'ASC')->get('month');
        return $registrationmonths;
    }

    public function getMonthlyUsers($month)
    {
        # code...
        $users = User::where('month', $month)->get();
        return $users;
    }
    public function getAppData()
    {
        # code...
        $dates = null;
        $availableHouseCategories = null;
        try {
            $dates = Houses::select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name'))
                ->distinct()
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();

            $availableHouseCategories = Houses::get('type')->unique('type');
        } catch (Exception $e) {
            $e->getMessage();
        }


        //linechart data
        $landlorddata = array();
        $landlorddata['countries'] = CountriesList::all();
        $landlorddata['counties'] = KenyaCounties::all();

        //set months
        $landlorddata['months']  = $this->getMonths($dates);
        $landlorddata['availableHouseCategories'] = $availableHouseCategories;
        $landlorddata['search_history'] = $this->searchHistory();
        $landlorddata['payment_gateways'] = $this->paymentGateways();
        $landlorddata['rental_types'] = $this->rentalTypes();


        return $landlorddata;
    }

    public function getMonths($periods)
    {

        $months = array();
        foreach ($periods as $period) {
            $month = $period->month_name;
            array_push($months, $month);
        }
        return $months;
    }


    public function searchHistory()
    {
        # code...
        $searches = array(
            "houses" => "Houses",
            "register" => "Register",
            "login" => "Login",
            "help" => "Help",
        );

        return $searches;
    }


    public function paymentGateways()
    {
        # code...
        $gateways = array(
            "DUKAVERSE" => "DUKAVERSE",
        );

        return $gateways;
    }


    public function rentalTypes()
    {
        # code...
        $rentals = array(
            "Offices" => "Offices",
            "Shops" => "Shops",
            "Appartments" => "Appartments",
            "Bedsitters" => "Bedsitters ",
            "One Bedrooms" => "One Bedrooms",
            "Two Bedrooms" => "Two Bedrooms",
            "Three Bedrooms" => "Two Bedrooms",
            "Four Bedrooms" => "Two Bedrooms",

        );

        return $rentals;
    }



    //sets pie chart data
    public function pieChartData($data, $month)
    {
        $pdata = array();
        # code...
        $color = $this->getColor();
        $value = $data;

        // $value = 20;
        $highlight = $this->getColor();
        $label = $month;

        $pdata['color'] = $color;
        $pdata['value'] = $value;
        $pdata['highlight'] = $highlight;
        $pdata['label'] = $label;
        return $pdata;
    }

    //gets random color value
    public function getColor()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
