<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResController;
use App\Models\Td_billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BillingController extends ResController
{
    public function create_bill(Request $r)
    {
        try {

            $rules = [
                "data" => 'required'
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError($valaditor->errors(), 400);
            }
            $databar = Td_billing::where("resturent_id",auth()->user()->resturent_dtls)->latest()->first();
            $bill_id = $databar ? $databar->billing_id : 0;

            foreach ($r->data as $stordata) {
                Td_billing::create([
                    "billing_id" => $bill_id + 1,
                    "customer_id" => $stordata['customer_id'],
                    "food_id" => $stordata['food_id'],
                    "catagory_id" => $stordata['catagory_id'],
                    "price" => $stordata['price'],
                    "total_price" => $stordata['total_price'],
                    "qty" => $stordata['qty'],
                    "resturent_id" => auth()->user()->resturent_dtls,
                    "create_by" => auth()->user()->id
                ]);
            }


            $billInfo = [
                "billing_id" => $bill_id + 1
            ];
            return $this->sendResponse($billInfo, "bill create successfully");
        } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }
    }


    public function list_bill()
    {
        try {
            $result = Td_billing::where("resturent_id",auth()->user()->resturent_dtls)
                                    ->groupBy("billing_id","create_at")->select("billing_id","create_at")->get();
            return $this->sendResponse($result, "unit list");
        } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }
    }
}
