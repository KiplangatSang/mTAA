<?php

namespace App\Repositories;

use App\Accounts\Account;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Return_;

class TransactionsRepository
{

    protected $STRLENGTH = 8;
    protected $account = null;
    public function __construct($account)
    {
        $this->account = $account;
    }
    public function saveTransaction(
        $gateway,
        $sender_account_id,
        $receiver_account_id,
        $sender_phone_number = null,
        $receiver_phone_number = null,
        $amount,
        $message,
        $trans_type,
        $cost,
        $currency,
        $purpose,
        $purposeable_id = null

    ) {
        # code...
        if ($purposeable_id)
            $purposeable_type = $this->setPurposeable($purpose);
        else
            $purposeable_type = null;

        $code = "MNA" . Str::random($this->STRLENGTH) . "OP" . rand(10, 99);
        $result =  $this->account->accountTransactions()->create([
            "trans_id" => $code,
            "sender_accounts_id" => $sender_account_id,
            "receiver_accounts_id" => $receiver_account_id,
            "amount" => $amount,
            "gateway" => $gateway,
            "status" => false,
            "transaction_type" => $trans_type,
            "message" => $message,
            "cost" => $cost,
            "currency" => $currency,
            "purpose" => $purpose,
            "total_amount" => $cost + $amount,
            "purposeable_id" => $purposeable_id,
            "purposeable_type" => $purposeable_type,
            "sender_phone_number" => $sender_phone_number,
            "receiver_phone_number" => $receiver_phone_number

        ]);

        return $result;
    }


    public function getAdminAccount()
    {
        # code...
        $admin_account = Account::where('id', 0)->first();
        return $admin_account;
    }

    public function getTransaction($id)
    {
        # code...
        $transaction = $this->account->accountTransactions()->where('id', $id)
            ->first();
        return $transaction;
    }

    public function getTransactions()
    {
        # code...
        $transactions = $this->account->accountTransactions()
            ->get();
        return $transactions;
    }
    public function getSalesTransactions()
    {
        # code...
        $transactions = $this->account->accountTransactions()
            ->where('purpose', "SALES")
            ->get();
        return $transactions;
    }
    public function getSuppliesTransactions()
    {
        # code...
        $transactions = $this->account->accountTransactions()
            ->where('purpose', "SUPPLY")
            ->get();
        return $transactions;
    }
    public function getLoansTransactions()
    {
        # code...
        $transactions = $this->account->accountTransactions()
            ->where('purpose', "LOANS")
            ->get();
        return $transactions;
    }

    public function setPurposeable($purpose)
    {
        # code...
        if ($purpose == "SALES") {
            $purposable_type = "App\Sales\Sales";
        } else if ($purpose == "LOANS") {
            $purposable_type = "App\Loans\Loans";
        } else if ($purpose == "SUPPLIES") {
            $purposable_type = "App\Supplies\Supplies";
        } else {
            $purposable_type = null;
        }

        return   $purposable_type;
    }
}
