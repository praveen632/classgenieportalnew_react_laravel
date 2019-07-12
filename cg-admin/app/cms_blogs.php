<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class cms_blogs extends Model
{
	public function getdata()
	{
		return $data = DB::select( DB::raw("SELECT * FROM `cms_blogs` ORDER BY id DESC "));
	}

	public function saveblog($request)
	{
		$insert = DB::table(ED_BLOGS)->insert(array('title'=>$request['title'], 'description'=>$request['description'],'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')));
		if($insert){
			return 1;
		}else{
			return 0;
		}
	}

	public function editdata($blog_id){
	$edit = DB::table(ED_BLOGS)->where('id', $blog_id)->first();
	$count = count($edit);
	if($count > 0)
	{
		return $edit;
	}
	else
	{
		return 0; 
	}
}

public function deletedata($blog_id){
	$res = DB::table(ED_BLOGS)->where('id', '=', $blog_id)->delete();
		if($res){
			return 1;
		}else{
			return 0;
		}
	}
	
public function updatedata($request, $blog_id){
	$edit = DB::table(ED_BLOGS)->where('id', $blog_id)->update(array('title'=>$request->title, 'description'=>$request->description,'updated_at'=> date('Y-m-d H:i:s')));
		$count = count($edit);
		if($count > 0)
		{
			return $count;
		}
		else
		{
			return 0; 
		}
	}
}
