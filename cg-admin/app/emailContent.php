<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
class emailContent extends Model{
	protected $table = ED_EMAIL;
	public function saveEmailData($data)
{  
	if($data['id'] != '')
	{
		echo $data['id'];
		$insert = DB::table(ED_EMAIL)
		->where('id', $data['id'])  // find your user by their email
		->limit(1)  // optional - to ensure only one record is updated.
		->update(array('type'=>$data['type'],'from_email'=>$data['from_email'],'subject'=>$data['subject'],'body'=>$data['editor1'],'feature'=>$data['editor2'],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'status'=>$data['status']));
	}else{
		$insert = DB::table(ED_EMAIL)->insert(array('type'=>$data['type'],'from_email'=>$data['from_email'],'subject'=>$data['subject'],'body'=>$data['editor1'],'feature'=>$data['editor2'],'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s'),'status'=>$data['status']));
	}
	if($insert){
		return 1;
	}else{
		return 0;
	}
}

public function getEmailData()
{
	$users = DB::table(ED_EMAIL)
	->select('id','type','from_email','subject','body','feature','status')
	->get();
	$count = count($users);
	if($count > 0){
		return $users;
	}
	else{
		return 0; 
	}	
}

public function getEditContent($id)
{
	$data = DB::table(ED_EMAIL)->select('id','type','from_email','subject','body','feature','status')->where('id','=',$id)->get();	
	if(count($data) != 0){
		return $data;
	}
	else{
		return 0;
	}
}

public function getEmailContent($params=array(), $apply_limit=true){	
	$data = [];
	$where = " WHERE 1=1 ";	
	$limit = (isset($params['start']) && isset($params['per_page']) && $params['start']>-1 && !empty($params['per_page'])) ? " LIMIT $params[start], $params[per_page] " : " 1, ".PAGE_SIZE." ";
	$sort_by = (isset($params['sort_by']) && $params['sort_by']=='D') ? " desc ":" asc ";
	if(isset($params['id']) && !empty($params['id'])){
		$where .= " AND id like ? ";
		$data[] = trim($params['id'])."%";
	}
	if(isset($params['type']) && !empty($params['type'])){
		$where .= " AND type like ? ";
		$data[] = trim($params['type'])."%";
	}
	if(isset($params['subject']) && !empty($params['subject'])){
		$where .= " AND subject like ? ";
		$data[] = trim($params['subject'])."%";
	}
	$QUERY = " SELECT count(id) as total FROM ".ED_EMAIL." $where ORDER BY `status` $sort_by";
	$total_num_entries =  current(DB::select($QUERY, $data))->total;
	$QUERY = " SELECT * FROM ".ED_EMAIL." $where ORDER BY `status` $sort_by ".($apply_limit ? $limit : ""); 
	return array('total_num_entries'=>$total_num_entries, 'rst'=>DB::select($QUERY, $data));
}
}