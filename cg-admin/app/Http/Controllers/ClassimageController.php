<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\cms_image;
use Session;

class ClassimageController extends Controller
{
  /****** Display a listing of class Management *****/
  public function index()
  {
    $req = new cms_image();
    $imagemang = $req->getdata();
    return view('imagemanagement.class.index',compact('imagemang'));
  }

  /****** Show the form for creating a new class ******/
  public function create()
  {
    return view('imagemanagement.class.create');
  }

  /****** Store a newly created class *****/
  public function store(Request $request)
  {
    $validator = $this->validate($request, [
      'image' => 'required',
      'title' => 'required',
      'order' => 'required',
      ]);
    $req = new cms_image();
    $insert = $req->adddata($request);
    if($insert ==1){
      Session::flash('message', 'Record is inserted!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/class'); 
  }

  /****** Show the form for edit class.******/
  public function edit($id)
  {
    $req = new cms_image();
    $edit = $req->editdata($id);
    return view('imagemanagement.class.edit',compact('edit'));
  }

  /****** Update the specified class. ******/
  public function update(Request $request, $id)
  {
    $req  = new cms_image();
    $update = $req->updatedata($request, $id);
    if($update == 1){
      Session::flash('message', 'Record Updated!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/class');
  }

  /****** Remove the specified class ******/
  public function destroy($id)
  {
    $req  = new cms_image();
    $delete = $req->deletedata($id);
    if($delete == 1){
      Session::flash('message', 'Record Updated!'); 
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/class');
  }
}
