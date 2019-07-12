<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class cms_role extends Model
{
	protected $table = ED_ROLES;

	public function getdata(){
		return $staffmang  = DB::table(ED_ROLES)->get();
	}

	public function adddata($request){

		$insert = $id = DB::table(ED_ROLES)->insert(array('role_name'=>$request->role_name, 'module_list' => implode(',', $request->module)));
		if($insert){
			return 1;
		}else{
			return 0;
		}
	} 

	public function editdata($id){
		$edit = DB::table(ED_ROLES)->where('id', $id)->first();
		$count = count($edit);
		if($count > 0)
		{
			return $edit;
		}else{
			return 0; 
		}
	}

	public function updatedata($request, $id){
		$staffUpdate=$request->all();
		$module = implode(',', $request->module);
		$updatearray = array('role_name' => $request->role_name,
			'module_list'=> $module,  );
		$update = DB::table(ED_ROLES)->where('id', $id)->update(($updatearray));
		if($update){
			return 1;
		}else{
			return 0;
		}
	}

	public function deletedata($id){
		$res = DB::table(ED_ROLES)->where('id', '=', $id)->delete();
		if($res){
			return 1;
		}else{
			return 0;
		}
	}
}
