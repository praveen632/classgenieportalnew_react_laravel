<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\cms_skill;
use Session;

class StudentskillController extends Controller
{
  /****** Display a listing of class Management *****/
  public function index()
  {
    $req = new cms_skill();
    $imagemang = $req->getdata();
    return view('imagemanagement.skill.index',compact('imagemang'));
  }

  /****** Show the form for creating a new class ******/
  public function create()
  {
    return view('imagemanagement.skill.create');
  }

  /****** Store a newly created class *****/
  public function store(Request $request)
  {
    $validator = $this->validate($request, [
      'image' => 'required',
      'title' => 'required',
      'order' => 'required',
      ]);
    $req = new cms_skill();
    $insert = $req->adddata($request);
    if($insert ==1){
      Session::flash('message', 'Record is inserted!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/skill'); 
  }

  /****** Show the form for edit class.******/
  public function edit($id)
  {
    $req = new cms_skill();
    $edit = $req->editdata($id);
    return view('imagemanagement.skill.edit',compact('edit'));
  }

  /****** Update the specified class. ******/
  public function update(Request $request, $id)
  {
    $req  = new cms_skill();
    $update = $req->updatedata($request, $id);
    if($update == 1){
      Session::flash('message', 'Record Updated!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/skill');
  }

  /****** Remove the specified class ******/
  public function destroy($id)
  {
    $req  = new cms_skill();
    $delete = $req->deletedata($id);
    if($delete == 1){
      Session::flash('message', 'Record Updated!'); 
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/skill');
  }
}