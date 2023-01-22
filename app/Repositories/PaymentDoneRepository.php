<?php

namespace App\Repositories;

use App\Accounts\Transaction;

class PaymentDoneRepository
{
    private $transaction;
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    //check type of transaction
    public function index()
    {
        # code...
        /*
* transaction_type= 1=>internal within dukaverse accounts paying for Dukaverse Products ie loans payment
         *                   2=>internal within the dukaverse accounts but not paying for dukaverse products ie deposit,transfer
         *                   3=>external and the money is not involded with dukaverse ie cash payments(just to help keep track)
         * message = message tied up with sending the transaction
        */
        $transaction = $this->transaction;
        $gateway = $transaction->gateway;
        info('gateway' . $gateway);
        switch ($gateway) {
            case "DUKAVERSE":
                $senderupdate = $this->calculateSenderUpdate($transaction);
                $receiverupdate = $this->calculateReceiverUpdate($transaction);
                break;
            case "MPESA":
                $senderupdate = $this->calculateReceiverUpdate($transaction);
                $receiverupdate = true;
                break;
        }
        if ($senderupdate && $receiverupdate)
            return true;
        else
            return false;
    }

    public function calculateSenderUpdate($transaction)
    {
        # code...
        $account = $transaction->senderAccount;
        $initial_amount = $account->balance;
        $amount_to_deduct = $transaction->total_amount;
        $new_amount = $initial_amount - $amount_to_deduct;

        return  $this->updateAccount($account, $new_amount);
    }
    public function calculateReceiverUpdate($transaction)
    {
        # code...
        $account = $transaction->receiverAccount;
        $initial_amount = $account->balance;
        $amount_to_add = $transaction->total_amount;
        $new_amount = $initial_amount + $amount_to_add;
        return  $this->updateAccount($transaction->receiverAccount, $new_amount);
    }

    public function updateAccount($account, $amount)
    {
        # code...
        $update =  $account->update(
            ["balance" => $amount]
        );

        if (!$update)
            return false;
        return $update;
    }
}
