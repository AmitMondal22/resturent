<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResController;
use App\Models\Md_catagory;
use App\Models\Md_food;
use App\Models\Md_unit_mastar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MasterController extends ResController
{
    public function add_unit(Request $r)
    {
        try {
            $rules = [
                "unit_name" => 'string|required'
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError($valaditor->errors(), 400);
            }

            $result = Md_unit_mastar::create([
                "resturent_id" => auth()->user()->resturent_dtls,
                "unit_name" => $r->unit_name,
                "create_by" => auth()->user()->id
            ]);
            return $this->sendResponse($result, "unit add successfully");
        } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }
    }



    public function list_unit()
    {
        try {
            $result = Md_unit_mastar::where("resturent_id",auth()->user()->resturent_dtls)->get();
            return $this->sendResponse($result, "unit list");
        } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }
    }



    public function add_food(Request $r)
    {
        try {
            $rules = [
                "food_name" => 'string|required',
                "food_price" => 'numeric|required',
                "unit_id" => 'numeric|required',
                "catagory_id" => 'numeric|required'
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError($valaditor->errors(), 400);
            }

            $result = Md_food::create([
                "food_name"=>$r->food_name,
                "food_price"=>$r->food_price,
                "unit_id"=>$r->unit_id,
                "catagory_id"=>$r->catagory_id,
                "resturent_id"=>auth()->user()->resturent_dtls,
                "created_by"=>auth()->user()->id
            ]);
            return $this->sendResponse($result, "add food mastar");
        } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }
    }



    public function list_food()
    {
        try {
            $result = Md_food::join("md_unit_mastar AS a",'a.unit_id','=','md_food.unit_id')
                                ->join("md_catagory AS b",'b.catagory_id','=','md_food.catagory_id')
                                ->select("md_food.*","a.unit_name",'b.catagory_name')
                                ->where("md_food.resturent_id",auth()->user()->resturent_dtls)->get();
            return $this->sendResponse($result, "food list");
        } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }
    }


    public function search_food(Request $r)
    {
        try {
            $rules = [
                "search" => 'string|required'
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError($valaditor->errors(), 400);
            }

            $result = Md_food::join("md_unit_mastar AS a",'a.unit_id','=','md_food.unit_id')
                                ->select("md_food.*","a.unit_name")
                                ->where('md_food.food_name', 'LIKE', '%' . $r->search . '%')
                                ->where("md_food.resturent_id",auth()->user()->resturent_dtls)->get();
            return $this->sendResponse($result, "serch food list");
        } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }
    }



    public function add_catagory(Request $r)
    {
        try {
            $rules = [
                "catagory_name" => 'string|required'
            ];
            $valaditor = Validator::make($r->all(), $rules);
            if ($valaditor->fails()) {
                return $this->sendError($valaditor->errors(), 400);
            }

            $result = Md_catagory::create([
                "resturent_id" => auth()->user()->resturent_dtls,
                "catagory_name" => $r->catagory_name,
                "create_by" => auth()->user()->id
            ]);
            return $this->sendResponse($result, "unit add successfully");
        } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }
    }



    public function list_catagory()
    {
        try {
            $result = Md_catagory::where("resturent_id",auth()->user()->resturent_dtls)->get();
            return $this->sendResponse($result, "unit list");
        } catch (\Throwable $th) {
            return $this->sendError($th, 400);
        }
    }



}
