<?php

namespace App\Http\Controllers;

use App\TimeRecord;
use App\TimeCoordinates;

use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;

class TimeRecordController extends Controller
{
    public function getTimeRecord(Request $request)
    {
        $time_rcd = TimeRecord::with('time_coordinates')->where('end_time', '!=', NULL)->where('employee_id', $request->id_member)->get();

        return response()->json([
            'status' => 'success',
            'data' => $time_rcd
        ], 200);
    }


    public function SaveIn_TimeWork(Request $request)
    {
        $date_ymd = date("Y-m-d");
        $date_time = date("H:i:s");



        $time_rcd = TimeRecord::where('date', $date_ymd)->where('employee_id', $request->id_member)->get();

        if (sizeof($time_rcd) == 0) {

            //------------------------------------- TimeRecord
            $time_rcd = new TimeRecord();
            $time_rcd->employee_id = $request->id_member;
            $time_rcd->date = $date_ymd;
            $time_rcd->start_time = $date_time;
            $time_rcd->end_time = NULL;

            $time_rcd->created_id = $request->id_member;
            $time_rcd->updated_id = $request->id_member;

            $time_rcd->save();
            //-------------------------------------

            //------------------------------------- TimeCoordinates
            $time_cre = new TimeCoordinates();
            $time_cre->employee_id = $request->id_member;
            $time_cre->date = $date_ymd;
            $time_cre->latitude = $request->latitude;
            $time_cre->longitude = $request->longitude;

            $time_cre->created_id = $request->id_member;
            $time_cre->updated_id = $request->id_member;

            $time_cre->save();
            //-------------------------------------


            return response()->json([
                'status' => 'success',
                'messages' => "บันทึกเวลาเข้างานเรียบร้อย !",
                'data' => $time_rcd
            ], 200);
        } else {

            return response()->json([
                'status' => 'error',
                'messages' => "คุณได้บันทึกเวลาเข้างานแล้ววันนี้ !",
                'data' => $time_rcd
            ], 200);
        }
    }

    public function SaveOut_TimeWork(Request $request)
    {
        $date_ymd = date("Y-m-d");
        $date_time = date("H:i:s");


        if (date("H") >= 12) { //เวลาเลิกงาน

            $time_rcd = TimeRecord::where('employee_id', $request->id_member)->where('date', $date_ymd)->first();

            if ($time_rcd) {
                if ($time_rcd->end_time == NULL) {

                    $time_rcd->end_time = $date_time;
                    $time_rcd->save();

                    return response()->json([
                        'status' => 'success',
                        'messages' => "บันทึกเวลาออกงานเรียบร้อย !"
                    ], 200);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'messages' => "คุณได้บันทึกเวลาออกงานเรียบร้อยแล้ววันนี้ !"
                    ], 200);
                }
            } else {

                return response()->json([
                    'status' => 'error',
                    'messages' => "คุณยังไม่ได้บันทึกเวลาเข้างานวันนี้ !"
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'messages' => "ไม่สามารถบันทึกได้เนื่องจาก ยังไม่ถึงเวลาเลิกงาน !"
            ], 200);
        }
    }
}
