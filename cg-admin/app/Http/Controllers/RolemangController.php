<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\cms_role;
use Session;

class RolemangController extends Controller
{
  /****** Display a listing of Role Management *****/
  public function index()
  {
    $req = new cms_role();
    $staffmang = $req->getdata();
    return view('rolemanagement.index',compact('staffmang'));
  }

  /****** Show the form for creating a new role ******/
  public function create()
  {
    return view('rolemanagement.create');
  }

  /****** Store a newly created role *****/
  public function store(Request $request)
  {
    $validator = $this->validate($request, [
      'role_name' => 'required',
      'module' => 'required',
      ]);

    $req = new cms_role();
    $insert = $req->adddata($request);
    if($insert ==1){
      Session::flash('message', 'Record is inserted!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('rolemanagement'); 
  }

  /****** Show the form for edit Role.******/
  public function edit($id)
  {
    $req = new cms_role();
    $edit = $req->editdata($id);
    return view('rolemanagement.edit',compact('edit'));
  }

  /****** Update the specified role. ******/
  public function update(Request $request, $id)
  {
    $req  = new cms_role();
    $update = $req->updatedata($request, $id);
    if($update == 1){
      Session::flash('message', 'Record Updated!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('logout');
  }

  /****** Remove the specified role ******/
  public function destroy($id)
  {
    $req  = new cms_role();
    $delete = $req->deletedata($id);
    if($delete == 1){
      Session::flash('message', 'Record Deleted!'); 
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('rolemanagement');
  }
}
