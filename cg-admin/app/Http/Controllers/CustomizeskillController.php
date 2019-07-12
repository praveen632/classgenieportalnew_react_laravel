<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\cms_customizeskill;
use Session;

class CustomizeskillController extends Controller
{
  /****** Display a listing of class Management *****/
  public function index()
  {
    $req = new cms_customizeskill();
    $imagemang = $req->getdata();
    return view('imagemanagement.customizeskill.index',compact('imagemang'));
  }

  /****** Show the form for creating a new class ******/
  public function create()
  {
    return view('imagemanagement.customizeskill.create');
  }

  /****** Store a newly created class *****/
  public function store(Request $request)
  {
    $validator = $this->validate($request, [
      'image' => 'required',
      'name' => 'required',
      'pointweight' => 'required',
      ]);
    $req = new cms_customizeskill();
    $insert = $req->adddata($request);
    if($insert ==1){
      Session::flash('message', 'Record is inserted!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/customizeskill'); 
  }

  /****** Show the form for edit class.******/
  public function edit($id)
  {
    $req = new cms_customizeskill();
    $edit = $req->editdata($id);
    return view('imagemanagement.customizeskill.edit',compact('edit'));
  }

  /****** Update the specified class. ******/
  public function update(Request $request, $id)
  {
    $req  = new cms_customizeskill();
    $update = $req->updatedata($request, $id);
    if($update == 1){
      Session::flash('message', 'Record Updated!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/customizeskill');
  }

  /****** Remove the specified class ******/
  public function destroy($id)
  {
    $req  = new cms_customizeskill();
    $delete = $req->deletedata($id);
    if($delete == 1){
      Session::flash('message', 'Record Updated!'); 
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/customizeskill');
  }
}