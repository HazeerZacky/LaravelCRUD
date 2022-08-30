<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\contacts;


class MyController extends Controller
{
    //==========================================================    Navigation parts Start   =======================
    public function HomePage(){ //Home Page 
        $a = session()->getId();
        $contacts = DB::table('contacts')->get();

        return view('Home',compact('contacts'));
    }

    //==========================================================    Navigation parts End   =======================

    //===========================================================    User Function Start   =======================

    // public function getusers(){

    //     $cont = DB::table('contacts')->get();

    //     return view('viewusers',compact('cont'));
    // }


    public function adduser(Request $req){

        // Validation Part
        $req->validate([
            'Name'=>'required',
            'CNo'=>'required|digits_between:9,10|numeric',
            'Email'=>'required|min:8',
            'Address'=>'required|min:8',
        ],[
            //Name Add
            'Name.required'=>'Name is must',
            //Contact No Add
            'CNo.required'=>'Contact No is must',
            'CNo.digits_between'=>'Contact No must be 9 or 10 digit',
            'CNo.numeric'=>'Enter numeric values',
            //Email Add
            'Email.required'=>'E-mail is must',
            'Email.min'=>'User E-mail: Minimum 8 letters',
            //Address Add
            'Address.required'=>'Address is must',
            'Address.min'=>'Address: Minimum 8 letters',
        ]);

        // Database Adding Part
        $cnt = count(DB::table('contacts')->get());
        
        $con = new Contacts;
        $con->name = $req->Name;
        $con->contactNo = $req->CNo;
        $con->email = $req->Email;
        $con->address = $req->Address;

        $con->save();

        // Notification Part
        $notification = array(
            'message' => 'Successfully Saved', 
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function edituser(Request $req) {
        
        // Validation Part
        $req->validate([
            'EName'=>'required',
            'ECNo'=>'required|digits_between:9,10|numeric',
            'EEmail'=>'required|min:8',
            'EAddress'=>'required|min:8',
        ],[
            //Name Add
            'EName.required'=>'Name is must',
            //Contact No Add
            'ECNo.required'=>'Contact No is must',
            'ECNo.digits_between'=>'Contact No must be 9 or 10 digit',
            'ECNo.numeric'=>'Enter numeric values',
            //Email Add
            'EEmail.required'=>'E-mail is must',
            'EEmail.min'=>'User E-mail: Minimum 8 letters',
            //Address Add
            'EAddress.required'=>'Address is must',
            'EAddress.min'=>'Address: Minimum 8 letters',
        ]);
        
        
        // Database Adding Part
        DB::table('contacts')->where('id' , $req->EID)->update([
            'name' => $req->EName,
            'contactNo' => $req->ECNo,
            'email' => $req->EEmail,
            'address' => $req->EAddress,
        ]);

        // Notification Part
        $notification = array(
            'message' => 'Successfully Updated', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function deleteuser($i){
        
        // Database Adding Part
        DB::table('contacts')->where('id',$i)->delete();

        // Notification Part
        $notification = array(
            'message' => 'Successfully Updated', 
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
