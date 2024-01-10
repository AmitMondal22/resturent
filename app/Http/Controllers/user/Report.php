<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResController;
use App\Models\Td_billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Report extends ResController
{
    function billing_report(Request $r)
    {
      //  try {
            $rules = [
                "from_date" => 'required',
                "to_date" => 'required'
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError($valaditor->errors(), 400);
            }
            $result = Td_billing::join('md_food', 'md_food.food_id', '=', 'td_billing.food_id')
                ->join('md_catagory', 'md_catagory.catagory_id', '=', 'md_food.catagory_id')
                ->join('md_unit_mastar', 'md_unit_mastar.unit_id', '=', 'md_food.unit_id')
                ->join('users', 'users.id', '=', 'td_billing.customer_id')
                ->select('td_billing.*','md_catagory.catagory_name', 'md_food.food_name', 'md_unit_mastar.unit_name', 'users.name as customer_name', DB::raw('SUM(td_billing.total_price) as total_price_sum'))
                ->where('td_billing.resturent_id', auth()->user()->resturent_dtls)
                ->whereBetween('td_billing.created_at', [$r->from_date, $r->to_date])
                ->groupBy('td_billing.billing_id','td_billing.total_price',"td_billing.id","td_billing.customer_id","td_billing.food_id","td_billing.catagory_id","td_billing.price","td_billing.qty","td_billing.resturent_id","td_billing.create_by","td_billing.created_at","td_billing.updated_at","md_catagory.catagory_name", "md_food.food_name", "md_unit_mastar.unit_name", "users.name")
                ->get();
            return $this->sendResponse($result, "billing report");
        /*} catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }*/
    }



    function billing_info_report(Request $r)
    {
        //try {
            $rules = [
                "billing_id" => 'required'
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError($valaditor->errors(), 400);
            }
            $result = Td_billing::join('md_food', 'md_food.food_id', '=', 'td_billing.food_id')
                ->join('md_catagory', 'md_catagory.catagory_id', '=', 'md_food.catagory_id')
                ->join('md_unit_mastar', 'md_unit_mastar.unit_id', '=', 'md_food.unit_id')
                ->join('users', 'users.id', '=', 'td_billing.customer_id')
                ->select('td_billing.*', 'md_catagory.catagory_name', 'md_food.food_name', 'md_unit_mastar.unit_name', 'users.name as customer_name')
                ->where('td_billing.resturent_id', auth()->user()->resturent_dtls)
                ->where('td_billing.billing_id', $r->billing_id)
                ->get();
            return $this->sendResponse($result, "billing report");
       /* } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }*/
    }
}
