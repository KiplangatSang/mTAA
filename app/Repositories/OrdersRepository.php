<?php

namespace App\Repositories;

class OrdersRepository
{
    private $account;
    public function __construct($account)
    {
        $this->account = $account;
    }
    public function getDisctictRequiredItems()
    {
        $orders = $this->account->orders()->distinct('itemName', 'itemSize')->get();
        foreach ($orders as $order) {
            $order->itemAmount = $this->account->orders()->where('itemName', $order->itemName)->sum('itemAmount');
            $order->price = $this->account->orders()->where('itemName', $order->itemName)->sum('price');
        }
        return $orders;
    }
    public function getAllorders()
    {
        $orders = $this->account->orders()->orderBy('created_at', 'DESC')->get();

        return $orders;
    }

    public function formatOrders()
    {
        # code...
        $orders = $this->account->orders()->orderBy('created_at', 'DESC')->get();
        foreach ($orders as $order) {
            $order->ordered_items = json_decode($order->ordered_items);
        }
        $ordersitems = count($orders);
        $ordersCost = $orders->where('payment_status', true)->sum('actual_cost');
        $ordersPaid = count($orders->where('payment_status', true));
        $ordersDelivered = count($orders->where('delivery_status', true));
        $ordersPending = count($orders->where('delivery_status', false));

        // dd( $ordersPaid);

        $orders = $orders;

        $ordersdata = array(
            'orders' =>  $orders,
            'ordersitems' => $ordersitems,
            'ordersCost' => $ordersCost,
            'ordersPaid' => $ordersPaid,
            'ordersDelivered' => $ordersDelivered,
            'ordersPending' => $ordersPending,
        );

        return $ordersdata;
    }

    public function getDeliveredOrders()
    {
        # code...
        $orders = $this->account->orders()->orderBy('created_at', 'DESC')
            ->where('order_status', 1)
            ->where('delivery_status', true)
            ->get();

        foreach ($orders as $order) {
            $order->ordered_items = json_decode($order->ordered_items);
            // $order->payment_status = $this->getStatus($order->payment_status);
        }
        $ordersitems = count($orders);
        $ordersCost = $orders->sum('actual_cost');
        $ordersPaid = count($orders->where('payment_status', true));
        $ordersDelivered = count($orders->where('delivery_status', true));
        $ordersPending = count($orders->where('delivery_status', false));
        $settledOrders = count($orders->where('order_status', 1));
        // dd( $ordersPaid);

        $allOrders["orders"] = $orders;

        $ordersdata = array(
            'allOrders' =>  $allOrders,
            'ordersitems' => $ordersitems,
            'ordersCost' => $ordersCost,
            'ordersPaid' => $ordersPaid,
            'ordersDelivered' => $ordersDelivered,
            'settledOrders' => $settledOrders,
        );

        return $ordersdata;
    }

    public function getPendingOrders()
    {
        # code...

        $orders = $this->account->orders()->orderBy('created_at', 'DESC')
            ->where('delivery_status', false)
            ->get();

        foreach ($orders as $order) {
            $order->ordered_items = json_decode($order->ordered_items);
            // $order->payment_status = $this->getStatus($order->payment_status);
        }
        $ordersitems = count($orders);
        $ordersCost = $orders->sum('projected_cost');
        $ordersPaid = count($orders->where('payment_status', true));
        // $ordersDelivered = count($orders->where('delivery_status', true));
        $ordersPending = count($orders->where('delivery_status', false));
        $receivedOrders = count($orders->where('order_status', 0));
        // dd( $ordersPaid);

        $allOrders["orders"] = $orders;

        $ordersdata = array(
            'allOrders' =>  $allOrders,
            'ordersitems' => $ordersitems,
            'ordersCost' => $ordersCost,
            'ordersPaid' => $ordersPaid,
            'ordersPending' => $ordersPending,
            'receivedOrders' => $receivedOrders,
        );

        return $ordersdata;
    }

    public function showOrderData($id)
    {
        # code...
        $orders = $this->account->orders()->where('id', $id)->first();
        //
        $orders->ordered_items = json_decode($orders->ordered_items);
        $ordersitems = 0;
        foreach ($orders->ordered_items as $items) {
            $ordersitems += $items->amount;
        }


        $ordersdata = array(
            'orders' =>  $orders,
            'ordersitems' => $ordersitems,
        );
        return $ordersdata;
    }



    //get sale by item id
    public function getOrdersById($itemid)
    {
        $order = $this->account->orders()->where('sales_empid', $itemid)->get();

        return $order;
    }

    //get employee sales
    public function getEmployeeOrders($empid)
    {
        $order = $this->account->orders()->where('employees_id', $empid)->get();

        return $order;
    }

    //get employee sales
    public function getordersByDate($startDate, $endDate)
    {
        $order = $this->account->orders()->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->get();
        return $order;
    }


    public function getordersCost()
    {
        $ordersPrice = $this->account->orders()->sum('price');
        # code...
        return $ordersPrice;
    }

    public function getOrders($key, $value)
    {
        $sales =  $this->account->orders()->where($key, $value)->orderBy('created_at', 'DESC')->get();
        //dd($sales);
        return $sales;
    }

    public function getStatus($id)
    {
        $status = "N/A";
        if ($id == -1) {
            $status = "Not Paid";
        } elseif ($id == 0) {
            $status = "Processed";
        } elseif ($id == 1) {
            $status = "Paid";
        }

        return $status;
    }
}
