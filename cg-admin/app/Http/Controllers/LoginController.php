<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class LoginController extends Controller
{
  /******** function for login module **********/
    public function checkLogin(Request $request){
       $validator = $this->validate($request, [
        'email' => 'required',
        'password' => 'required',
        ]);
     $input = $request->all();
     $SelectRecord = DB::table('cms_usermangs')
           ->join('cms_roles','cms_usermangs.role_id','=','cms_roles.id')
           ->select('cms_usermangs.*','cms_roles.module_list')
           ->where('cms_usermangs.email', $input['email'])
           ->orWhere('cms_usermangs.username', $input['email'])
           ->first();
     $count = count($SelectRecord);
     if ($count == 0)
         {
            Session::flash('message', 'Please Enter Correct Email Address / Username!'); 
            return view('/login');
         }else{
     /****** Password Check Match *******/     
     if (Hash::check($input['password'], $SelectRecord->password))
         {
           Session::put('data', $SelectRecord); 
           Session::put('useremail', $SelectRecord->email);
           Session::put('username', $SelectRecord->username);
      if (isset($_POST['remember']) && $_POST['remember'] == 'on') 
         {
           /** Set Cookie from here for one hour* */
           setcookie("email", $input['email'], time()+(60*60*1));
           setcookie("password", $input['password'], time()+(60*60*1));  /* expire in 1 hour */
         }
         return Redirect::to('/home');
         }else{
           Session::flash('message', 'Please Enter Correct Password!');
           return view('/login');
             }
       }
}

/**********  function call for Logout *************/
    public function checkLogout(Request $request){
        $request->session()->flush();
        return Redirect::to('/login');

      }
}
