<?php
namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
class cms_usermang extends Model
{
	protected $table = ED_USERMGMT;

	public function getdata(){
		return	$usermang = DB::table(ED_USERMGMT)
		->join(ED_ROLES, ED_USERMGMT.'.'.'role_id', '=', ED_ROLES.'.'.'id')
		->select(ED_USERMGMT.'.'.'*', ED_ROLES.'.'.'role_name')
		->get();
	}

	public function adddata($request){
		$insert = DB::table(ED_USERMGMT)->insert(array('username'=>$request->username, 'password'=>Hash::make($request->password), 'fname'=>$request->fname, 'lname'=>$request->lname, 'email'=>$request->email, 'role_id'=>$request->role));
		if($insert){
			return 1;
		}else{
			return 0;
		}
	} 

	public function editdata($id){
		$edit = DB::table(ED_USERMGMT)->where('id', $id)->first();
		$count = count($edit);
		if($count > 0)
		{
			return $edit;
		}else{
			return 0;
		}
	}

	public function deletedata($id){
		$res = DB::table(ED_USERMGMT)->where('id', '=', $id)->delete();
		if($res){
			return 1;
		}else{
			return 0;
		}
	}


	public function changepassword($request){

		$select = DB::table(ED_USERMGMT)->where('email', Session::get('useremail'))->first();
		if (Hash::check($request->Password, $select->password)){
		 $update =  DB::table(ED_USERMGMT)->where('email', Session::get('useremail'))->update(array('password' => hash::make($request->New_password))); 
			if($update){
				return 1;
			}else{
				return 0;
			}
		}else{
			return "error"; 
		}
	}
}


