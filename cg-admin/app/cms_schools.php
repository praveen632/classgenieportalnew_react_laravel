<?php
namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
class cms_schools extends Model 
{
	protected $table = ED_SCHOOL;
	public function getdata($params=array(), $apply_limit=true){
    //print_r($params['filter']);die;
		$limit = (isset($params['start']) && isset($params['per_page']) && $params['start']>-1 && !empty($params['per_page'])) ? " LIMIT $params[start], $params[per_page] " : " 1, ".PAGE_SIZE." ";

	  $sort_by = (isset($params['sort_by']) && $params['sort_by']=='D') ? " desc ":" asc ";

		$QUERY_SCH = " SELECT count(school_id) as total FROM ".ED_SCHOOL."";
		$total_num_entries =  current(DB::select($QUERY_SCH))->total;
	
    if(!empty($params['school_name'])){
		 $QUERY = " SELECT * FROM ".ED_SCHOOL." where school_name like '%".$params['school_name']."%' ORDER BY status $sort_by ".($apply_limit ? $limit : ""); 
		}else{
     if(isset($params['filter'])){
		      $QUERY = " SELECT * FROM ".ED_SCHOOL."  where status = '".$params['filter']."' ORDER BY school_name $sort_by ".($apply_limit ? $limit : ""); 
       }else{
         $QUERY = "SELECT * FROM ".ED_SCHOOL." where status = '0' ORDER BY school_name $sort_by ".($apply_limit ? $limit : "");   
       }
		}	

	   return array('total_num_entries'=>$total_num_entries, 'rst'=>DB::select($QUERY));
	}

 

	public function viewDetails($school_id){
     $select = DB::table(ED_SCHOOL)->where('school_id', $school_id)->first();
     if(count($select) >0){
     	return $select;
     }else{
     	return array();
     }
	}

	public function adddata($request){
		$insert = DB::table(ED_SCHOOL)->insertGetId(array('school_name'=>$request->school_name, 'address'=>$request->address, 'city'=>$request->city, 'state'=>$request->state, 'country'=>$request->country, 'pincode'=>$request->pincode, 'web_url'=>$request->web_url, 'email_id'=>$request->email_id, 'phone'=>$request->phone, 'status'=>'1', 'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')));

		//Select last inserted data.
        $users = DB::table(ED_SCHOOL)      
           ->select('school_id','school_name','address')
          ->where('school_id',$insert)
          ->first();
      //Data insert into word press database.
      $users2 = DB::connection('mysql1');
      $u = $users2->table('wp_uam_accessgroups')->insert(array('ID'=>$users->school_id,'groupname'=>$users->school_name,'groupdesc'=>$users->address));

		if($insert){
			return 1;
		}else{
			return 0;
		}
	} 

public function editdata($school_id){
	$edit = DB::table(ED_SCHOOL)->where('school_id', $school_id)->first();
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

public function updatedata($request, $school_id){	
	DB::table(ED_SCHOOL)->where('school_id', $school_id)->update(array('school_name'=>$request->school_name, 'address'=>$request->address, 'city'=>$request->city, 'state'=>$request->state, 'country'=>$request->country, 'pincode'=>$request->pincode, 'web_url'=>$request->web_url, 'email_id'=>$request->email_id, 'phone'=>$request->phone, 'status'=>$request->status, 'updated_at'=> date('Y-m-d H:i:s')));
	DB::table(ED_USERS)->where('school_id', $school_id)->update(array('status'=>$request->status, 'updated_at'=> date('Y-m-d H:i:s')));
  //if($request->status == '-1'){
   return $email = DB::table(ED_USERS)
           ->select('email','status')
           ->where('school_id','=',$school_id)
           ->get();
      //var_dump($email);die();
      //  if($email[0]->status == '-1'){
      //   return $email;
      // }else{
      //   return $email;
      // } 	
  }
 

public function deletedata($school_id){
	//$res = DB::table(ED_SCHOOL)->where('school_id', '=', $school_id)->delete();
	         DB::table('ed_users')
           ->where('school_id',$school_id) 
           ->update(['status'=>'-1']);
           DB::table('ed_schools')
           ->where('school_id',$school_id) 
           ->update(['status'=>'2']);
           $email = DB::table('ed_users')
           ->select('email')
           ->where('school_id','=',$school_id)
           ->get();

        if($email > 0){
            return $email;
          }else{
            return 0;
          }
           //Wordpress connection
          $users2 = DB::connection('mysql1');
          
          $uwp = $users2 ->table('wp_uam_accessgroups')->where('ID', '=', $school_id)->delete();

          $user3 = DB::table('ed_users')
           ->select('member_no')
           ->where('school_id','=',$school_id)
           ->first();
          $use = $user3->member_no;
          $uwp = $users2 ->table('wp_uam_accessgroup_to_object')->where('object_id',$use)->update(array('group_id'=>0));
           
          
	}

public function update_school($id){
 
       // $teacher_ac_no = DB::table('ed_school_teacher_request')
       //     ->where('school_id',$id) 
       //     ->update(['status'=>1]);
           $member_no = DB::table('ed_school_teacher_request')
           ->select('teacher_ac_no')
           ->where('school_id','=',$id)
           ->first();              
           $member_no = $member_no->teacher_ac_no;
           // DB::table('ed_users')
           // ->where('member_no','=',$member_no) 
           // ->update(['status'=>1]);
           DB::table('ed_classinfo')
           ->where('teacher_ac_no','=',$member_no) 
           ->update(['school_id'=>$id]);
           DB::table('ed_schools')
           ->where('school_id','=',$id) 
           ->update(['status'=>1]);
           //Select school information 
           $user = DB::table('ed_schools')
           ->select('school_id','school_name','address')
           ->where('school_id','=',$id)
           ->first();

                    
          //Data insert into word press database.
         $users2 = DB::connection('mysql1');
         $wps = $users2->table('wp_uam_accessgroups')->insert(array('ID'=>$user->school_id,'groupname'=>$user->school_name,'groupdesc'=>$user->address));
         
         $user3 = $users2->table('wp_uam_accessgroup_to_object')
           ->select('object_id')
           ->where('object_id','=',$member_no)
           ->first();
     if(count($user3) > 0){
        $uwp = $users2 ->table('wp_uam_accessgroup_to_object')->where('object_id', $member_no)->update(array('group_id'=>$user->school_id));
     }else{
     	$wp = $users2->table('wp_uam_accessgroup_to_object')->insert(array('object_id'=>$member_no,'object_type'=>'user','group_id'=>$user->school_id));
     }
        
           //return $member_no;
}

//*** For Get teacher's mail Id ***/
      public function get_email($id){
      	 $teacher_ac_no = DB::table('ed_school_teacher_request')
        ->select('teacher_ac_no')
        ->where('school_id','=',$id)
        ->first();        
        $teacher_mail = DB::table('ed_users')
        ->select('email')
        ->where('member_no','=',$teacher_ac_no->teacher_ac_no)
        ->first();
       return $teacher_mail->email;
     }


public function get_deleteemail($school_id){
  
                 
        $email = DB::table('ed_users')
        ->select('email')
        ->where('school_id','=',$school_id)
        ->get();
        
       return $email;
     }

}

