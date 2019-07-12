<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\cms_usermang;
use App\cms_role;
use Session;

class UsermangController extends Controller
{
  /****** Display a listing of users ********/
  public function index()
  {
    $req = new cms_usermang();
    $usermang = $req->getdata();
    return view('usermanagement.index',compact('usermang'));
  }

  /****** Show the form for creating a new User  *******/
  public function create()
  {
    $rolemang = cms_role::all();
    return view('usermanagement.create', compact('rolemang'));
  }

  /****** Insert a newly created Record. ******/
  public function store(Request $request)
  {
    $validator = $this->validate($request, [
      'username' => 'required',
      'password' => 'required',
      'fname' => 'required',
      'lname' => 'required',
      'email' => 'required',
      'role' => 'required',
      ]);
    $req = new cms_usermang();
    $insert = $req->adddata($request);
    if($insert ==1){
      Session::flash('message', 'Record is inserted!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('usermanagement'); 
  }

  /****** edit the specified resource. *******/
  public function edit($id)
  {
    $rolemang = cms_role::all();
    $req = new cms_usermang();
    $edit = $req->editdata($id);
    return view('usermanagement.edit',compact('edit','rolemang'));
  }

  /******* Update the specified record in storage.*****/
  public function update(Request $request, $id)
  {
    $userUpdate=$request->all();

    $checkpass = DB::table(ED_USERMGMT)->select('password')->where('id', $id)->first();
   
    if ($userUpdate['password']== "")
    {
      $password = $checkpass->password;

    }else{
      $password = hash::make($userUpdate['password']);
    }
    
    $updatearray = array('username' => $request->username,
      'password' => $password,
      'fname'    => $request->fname,
      'lname'    => $request->lname,
      'email'    => $request->email,
      'role_id'   => $request->role  );
    $update = DB::table(ED_USERMGMT)->where('id', $id)->update(($updatearray));
    Session::flash('message', 'Record Updated!');
    return redirect('usermanagement');
  }

  /****** Remove the specified User. *******/
  public function destroy($id)
  {
    $req  = new cms_usermang();
    $delete = $req->deletedata($id);
    if($delete == 1){
      Session::flash('message', 'Record Deleted!'); 
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('usermanagement');
  }
}
