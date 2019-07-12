<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use App\cms_usermang;

class ChangePasswordController extends Controller
{
  public function changePassword(Request $request){
    /**** Check Validator ******/    
    $validator = $this->validate($request, [
      'Password' => 'required',
      'New_password' => 'required',
      'Conf_password' => 'required|same:New_password',
      ]);
    $req = new cms_usermang();
    $changepassword = $req->changepassword($request);

    if($changepassword == 1){
      Session::flash('message', 'Password has been Updated!');
      return Redirect::to('/change_password');
    }elseif($changepassword == 0){
      Session::flash('message', 'database error!');
      return Redirect::to('/change_password');
    }else{
      Session::flash('message', 'Please enter Correct Password!');  
      return Redirect::to('/change_password');
    }
  }
}

	