<?php

namespace App\Http\Controllers;

use App\Customer;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class CustomerController extends Controller
{
    public function all()
    {
        $cust = Customer::all();

        return response()->json([
            'status' => 'success',
            'data' => $cust
        ], 200);
    }


    public function add(Request $request)
    {
        //$data = $request->json()->all();

        try {
            $cust = new Customer();

            $cust->name = $request->Cust['name'];
            $cust->tax_id = $request->Cust['tax_id'];
            $cust->telephone = $request->Cust['telephone'];
            $cust->fax = $request->Cust['fax'];
            $cust->email = $request->Cust['email'];
            $cust->person = NULL;
            $cust->address = $request->Cust['address'];
            $cust->district = $request->Cust['district'];
            $cust->city = $request->Cust['city'];
            $cust->province = $request->Cust['province'];
            $cust->country = $request->Cust['country'];
            $cust->postcode = $request->Cust['postcode'];
            $cust->coordinates = $request->coordinates;

            $cust->del_flg = 0;
            $cust->created_id = $request->id_member;
            $cust->updated_id = $request->id_member;
            $cust->save();

            return response()->json([
                'status' => 'success',
                'messages' => "เพิ่มรายการเรียบร้อย",
            ], 200);
        } catch (\PDOException $ex) {

            return response()->json([
                'status' => 'error',
                'messages' => "ไม่สามารถเพิ่มรายการได้ !",
                "data" => $ex
            ], 200);
        }
    }

    public function edit(Request $request)
    {
        $cust = Customer::find($request->Cust['cust_id']);

        $cust->name = $request->Cust['name'];
        $cust->tax_id = $request->Cust['tax_id'];
        $cust->telephone = $request->Cust['telephone'];
        $cust->fax = $request->Cust['fax'];
        $cust->email = $request->Cust['email'];
        $cust->person = NULL;
        $cust->address = $request->Cust['address'];
        $cust->district = $request->Cust['district'];
        $cust->city = $request->Cust['city'];
        $cust->province = $request->Cust['province'];
        $cust->country = $request->Cust['country'];
        $cust->postcode = $request->Cust['postcode'];
        $cust->coordinates = $request->Cust['coordinates'];

        $cust->save();

        return response()->json([
            'status' => 'success',
            'messages' => "แก้ไขรายกายสำเร็จ !",
            "data" => $cust
        ], 200);
    }
}
