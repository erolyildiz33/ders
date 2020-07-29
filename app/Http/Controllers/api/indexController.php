<?php

namespace App\Http\Controllers\api;

use App\Appointment;
use App\Http\Controllers\Controller;
use App\WorkingHours;
use Illuminate\Http\Request;

class indexController extends Controller
{
   public function getWokingHours($date='')
   {
       $returnarray=[];
       $date=($date=='') ? date("Y-m-d") : $date;
       $hours=WorkingHours::all();
       foreach ($hours as $k=>$v)
       {
           $kontrol=Appointment::where('date',$date)->where('workinghour',$v['id'])->count();
           $v['isActive']=($kontrol==0)? true : false;
          $returnarray[]=$v;
       }
    return response()->json($returnarray);
   }
}
