<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\cms_studentimage;
use Session;

class StudentimageController extends Controller
{
  /****** Display a listing of student image Management *****/
  public function index()
  {
    $req = new cms_studentimage();
    $imagemang = $req->getdata();
    return view('imagemanagement.student.index',compact('imagemang'));
  }

  /****** Show the form for creating a new student image ******/
  public function create()
  {
    return view('imagemanagement.student.create');
  }

  /****** Store a newly created student image *****/
  public function store(Request $request)
  {
    $validator = $this->validate($request, [
      'image' => 'required',
      'title' => 'required',
      'order' => 'required',
      ]);
    $req = new cms_studentimage();
    $insert = $req->adddata($request);
    if($insert ==1){
      Session::flash('message', 'Record is inserted!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/student'); 
  }

  /****** Show the form for edit student image.******/
  public function edit($id)
  {
    $req = new cms_studentimage();
    $edit = $req->editdata($id);
    return view('imagemanagement.student.edit',compact('edit'));
  }

  /****** Update the specified student image. ******/
  public function update(Request $request, $id)
  {
    $req  = new cms_studentimage();
    $update = $req->updatedata($request, $id);
    if($update == 1){
      Session::flash('message', 'Record Updated!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('imagemanagement/student');
  }

  /****** Remove the specified student image ******/
  public function destroy($id)
  {
    $req  = new cms_studentimage();
    $delete = $req->deletedata($id);
    if($delete == 1){
      Session::flash('message', 'Record Updated!'); 
    }else{
      Session::flash('message', 'Database Error!');
    }

    return redirect('imagemanagement/student');
  }
}
