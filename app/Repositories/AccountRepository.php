<?php

namespace App\Repositories;

use App\LoanApplication;
use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\BaseController;
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
use Illuminate\Support\Str;

class AccountRepository
{
    public function createAccount($account, $request)
    {

        $start_code = null;
        $account_number_code = null;
        $account_name = null;
        $account_ref = null;

        switch ($request->accountType) {
            case "Client":
                $start_code = "DV_CL";
                $account_number_code = rand(1000000, 1000000);
                $account_name = $start_code . $account_number_code;
                $account_ref = $start_code . Str::random(7);
                break;
            case "Retail":
                $start_code = "DV_RTL";
                $account_number_code = rand(100000, 1000000);
                $account_name = $start_code . $account_number_code;
                $start_code = $start_code . substr($account->retail_county, 0, 3);
                $account_ref = $start_code . Str::random(7);
                break;
            case "Supplier":
                $start_code = "DV_SPL";
                $account_number_code = rand(1000000, 1000000);
                $account_name = $start_code . $account_number_code;
                $account_ref = $start_code . Str::random(7);
                break;
            case "Admin":
                $start_code = "DV_ADM";
                $account_number_code = rand(10000, 100000);
                $account_name = $start_code . $account_number_code;
                $account_ref = $start_code . Str::random(6);
                break;
            default:
                $start_code = "DV_CL";
                $account_number_code = rand(100000, 1000000);
                $account_name = $start_code . $account_number_code;
                $account_ref = $start_code . Str::random(7);
        }


        # code...
        $result = $account->accounts()->create(
            [
                "account" => $account_name,
                "account_ref" => $account_ref,
            ]
        );
        return  $result;
    }
}
