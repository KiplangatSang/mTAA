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

class AppRepository
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
                }else{
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

    public function getRevenue($retail, $month)
    {
        # code...
        $revenueRepo = new SalesRepository($retail);
        $revenue = $revenueRepo->getRevenue("month", $month);
        return $revenue;
    }

    public function getExpenses($retail, $month)
    {
        # code...
        $expenseRepo = new ExpenseRepository($retail);
        $expenses = $expenseRepo->getExpenses($retail, $month);
        return $expenses;
    }


    public function getProfit($retail, $month)
    {
        # code...
        $profit = 0;
        if ($this->getRevenue($retail, $month) && $this->getExpenses($retail, $month)) {
            $profit = $this->getRevenue($retail, $month) - $this->getExpenses($retail, $month);
        }
        return $profit;
    }

    public function getRevenueGrowth($retail, $month)
    {
        # code...
        $thisMonthRev = $this->getRevenue($retail, $month);
        $lastMonthRev = $this->getRevenue($retail, $month);
        $growth = $thisMonthRev - $lastMonthRev;
        $growthPercentile = ($growth / $thisMonthRev) * 100;

        return $growthPercentile;
    }

    public function getExpenseGrowth($retail, $month)
    {
        # code...
        $thisMonthEx = $this->getExpenses($retail, $month);
        $lastMonthEx = $this->getExpenses($retail, $month);
        $growth = $thisMonthEx - $lastMonthEx;
        $growthPercentile = ($growth / $thisMonthEx) * 100;

        return $growthPercentile;
    }

    public function getProfitGrowth($retail, $month)
    {
        $thisMonthProfit = $this->getProfit($retail, $month);
        $lastMonthProfit = $this->getProfit($retail, $month);
        $growth = $thisMonthProfit - $lastMonthProfit;
        $growthPercentile = ($growth / $thisMonthProfit) * 100;

        return $growthPercentile;
    }


    public function getAppData()
    {
        # code...
        $baseController  = new BaseController();
        $retail = $baseController->getRetail();
       // dd( $retail);

        $expenseRepo = new ExpenseRepository($retail);
        $salesRepo = new SalesRepository($retail);
        $revenueRepo = new RevenueRepository($retail);
        $profitRepo = new ProfitRepository($retail);
        $stockRepo = new StockRepository($retail);
        $requiredItemsRepo = new RequiredItemsRepository($retail);
        $orderRepo = new OrdersRepository($retail);
        $employeeRepo = new EmployeesRepository($retail);
        $suppliesrRepo = new SuppliesRepository($retail);
        $loansRepo = new LoansRepository($retail);

        $dates = null;
        try {
            $dates = $retail->salesTransactions()
                ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name'))
                ->distinct()
                ->orderBy('year', 'asc')
                ->orderBy('month', 'asc')
                ->get();
        } catch (Exception $e) {
            $e->getMessage();
        }


        //linechart data
        $data = array();
        //dd($dates);

        //set months
        $data['months']  = $this->getMonths($dates);


        //piechart data
        $salesPData = array();
        $expensePData = array();
        $revenuePData = array();
        $stockPData = array();
        $loansPData = array();

        $salesData = array();
        $expenseData = array();
        $revenueData = array();
        $stockData = array();
        $loansData = array();

        foreach ($dates as $date) {
            $month = $date->month;
            $monthName = $date->month_name;
            $sales = $this->getMonthlySales($salesRepo, $month);

            $expenses = $this->getMonthlyExpense($expenseRepo, $month);;
            $revenue = $this->getMonthlyRevenue($revenueRepo, $month);
            $stock = count($stockRepo->getDisctictStockItems($month));
            $loans = $this->getLoanApplications($loansRepo, $month);

            //set piechart data
            $salesPData[] = $this->pieChartData($sales, $monthName);
            $expensePData[] = $this->pieChartData($expenses, $monthName);
            $revenuePData[] = $this->pieChartData($revenue, $monthName);
            $stockPData[] = $this->pieChartData($stock, $monthName);
            $loansPData[] = $this->pieChartData($loans, $monthName);


            //linechart data
            $salesData[] = $sales;
            $expenseData[] = $expenses;
            $revenueData[] = $revenue;
            $stockData[] = $stock;
            $loansData[] = $loans;
        }

        //linechart data
        $data['salesData']  = $salesData;
        $data['expenseData'] = $expenseData;
        $data['revenueData'] = $revenueData;
        $data['stockData']  = $stockData;
        $data['loansData']  = $loansData;

        //piechart data

        $data['salesPData']  = $salesPData;
        $data['expensePData'] = $expensePData;
        $data['revenuePData'] = $revenuePData;
        $data['stockPData']  = $stockPData;
        $data['loansPData']  = $loansPData;


        $data['sales_value'] = $this->getMonthlySales($salesRepo);
        // $data['expenses_value'] = $expenseRepo->getAllExpenses();
        $data['expenses_value'] = $this->getMonthlyExpense($expenseRepo, date("m"));
        //$data['revenue_value'] =  $revenueRepo->getAllRevenue();
        $data['revenue_value'] =  $this->getMonthlyRevenue($revenueRepo, date("m"));
        $data['profit_value'] = $profitRepo->getProfit();

        $data['sales_growth'] =  $salesRepo->getSalesGrowth();
        $data['expenses_growth'] =  $expenseRepo->getExpensesGrowth();
        $data['revenue_growth'] = $revenueRepo->getRevenueGrowth();
        $data['profit_growth'] = $profitRepo->getProfitGrowth();

        $data['sold_items'] = $salesRepo->getSoldItems();
        $data['stock'] = count($stockRepo->getDisctictStock());
        $data['required_items'] = count($requiredItemsRepo->getAllRequiredItems());
        $data['ordered_items'] = count($orderRepo->getAllorders());

        $data['employees'] = count($employeeRepo->getEmployees());
        $data['supplies'] =  count($suppliesrRepo->getAllSupplies());
        $data['orders'] = count($orderRepo->getAllorders());
        $data['loans'] = count($loansRepo->getLoanApplications());

        $data['retail'] = $retail;

        return $data;
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

    public function getLoanApplications($loansRepo, $month)
    {

        // $loans = array();
        $loan = $loansRepo->getAppliedLoans($month, null)->sum("loan_amount");
        //array_push($loans, $loan);
        return $loan;
    }

    public function getMonthlyRevenue($revenueRepo, $period)
    {


        $revenue = $revenueRepo->getMonthlyRevenue($period)->sum('revenue');

        return $revenue;
    }

    public function getMonthlyExpense($expenseRepo, $period)
    {

        $expense = $expenseRepo->getMonthlyExpenses($period)->sum('expense');

        return $expense;
    }

    public function getMonthlySales($salesRepo = null, $period = null)
    {
        $sale = $salesRepo->getMonthlySales($period)->sum('paid_amount');
        //dd( $sale);
        return $sale;
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
