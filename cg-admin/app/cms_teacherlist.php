<?php
namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
class cms_teacherlist extends Model
{
  protected $table = ED_USERS;
      //***For getting List of School Name and Teacher Name***/
      public function getdata(){
            return $data = DB::table('ed_users')
            ->join('ed_schools', 'ed_users.school_id', '=', 'ed_schools.school_id')
            ->select('ed_users.name', 'ed_schools.school_name')
            ->get();
      }

      //*** Getting School Name and Teacher Name on searching//
      public function get_teacher_list($params=array(), $apply_limit=true){

          $limit = (isset($params['start']) && isset($params['per_page']) && $params['start']>-1 && !empty($params['per_page'])) ? " LIMIT $params[start], $params[per_page] " : " 1, ".PAGE_SIZE." ";
          
          $sort_by = (isset($params['sort_by']) && $params['sort_by']=='D') ? " desc ":" asc ";
          
           if(!empty($params['school_name'])){

            $data = "SELECT ed_users.name, ed_schools.school_name,ed_school_teacher_request.status,ed_school_teacher_request.id FROM ed_users JOIN ed_school_teacher_request ON ed_users.member_no =ed_school_teacher_request.teacher_ac_no JOIN ed_schools ON ed_schools.school_id=ed_school_teacher_request.school_id WHERE ed_schools.school_name = '".$params['school_name']."' AND ed_school_teacher_request.status = '0' AND ed_users.status>='0' ".($apply_limit ? $limit : "");

            

            //  $data = DB::table('ed_users')
            // ->join('ed_school_teacher_request', 'ed_users.member_no', '=', 'ed_school_teacher_request.teacher_ac_no')
            // ->join('ed_schools', 'ed_schools.school_id', '=', 'ed_school_teacher_request.school_id')
            // ->select('ed_users.name', 'ed_schools.school_name','ed_school_teacher_request.status','ed_school_teacher_request.id')
            //  ->where ('ed_schools.school_name','=',$school_name)
            //  ->where ('ed_school_teacher_request.status','=','0')
            //  ->where ('ed_users.status','>=','0')
            //  ->skip($params['start'])->take($params['per_page'])
            // ->get();
            $data_T = "SELECT ed_users.name, ed_schools.school_name,ed_school_teacher_request.status,ed_school_teacher_request.id FROM ed_users JOIN ed_school_teacher_request ON ed_users.member_no =ed_school_teacher_request.teacher_ac_no JOIN ed_schools ON ed_schools.school_id=ed_school_teacher_request.school_id WHERE ed_schools.school_name = '".$params['school_name']."' AND ed_school_teacher_request.status = '0' AND ed_users.status>='0' ";
            $total_num_entries =  count(DB::select($data_T));
            }
           else
           {

            $data = "SELECT ed_users.name, ed_schools.school_name,ed_school_teacher_request.status,ed_school_teacher_request.id FROM ed_users JOIN ed_school_teacher_request ON ed_users.member_no =ed_school_teacher_request.teacher_ac_no JOIN ed_schools ON ed_schools.school_id = ed_school_teacher_request.school_id WHERE ed_school_teacher_request.status = '0' AND ed_users.status>='0'" .($apply_limit ? $limit : "");
           

            // $data = DB::table('ed_users')
            // ->join('ed_school_teacher_request', 'ed_users.member_no', '=', 'ed_school_teacher_request.teacher_ac_no')
            // ->join('ed_schools', 'ed_schools.school_id', '=', 'ed_school_teacher_request.school_id')
            // ->select('ed_users.name', 'ed_schools.school_name','ed_school_teacher_request.status','ed_school_teacher_request.id')
            //  ->where ('ed_school_teacher_request.status','=','0')
            // ->where ('ed_users.status','>=','0')
            // ->skip($params['start'])->take($params['per_page'])
            // ->get(); 
            $data_T = "SELECT ed_users.name, ed_schools.school_name,ed_school_teacher_request.status,ed_school_teacher_request.id FROM ed_users JOIN ed_school_teacher_request ON ed_users.member_no =ed_school_teacher_request.teacher_ac_no JOIN ed_schools ON ed_schools.school_id = ed_school_teacher_request.school_id WHERE ed_school_teacher_request.status = '0' AND ed_users.status>='0'"; 
            $total_num_entries =  count(DB::select($data_T));
            }
   
             return array('total_num_entries'=>$total_num_entries, 'rst'=>DB::select($data));
       }

      //*** For update the teacher status***/ 
        public function update_teacher_status($id){
         $teacher_ac_no = DB::table('ed_school_teacher_request')
           ->where('id',$id) 
           ->update(['status'=>1]);
           $member_no = DB::table('ed_school_teacher_request')
           ->select('teacher_ac_no','school_id')
           ->where('id','=',$id)
           ->first();
           $school_id = $member_no->school_id;
           $member_no = $member_no->teacher_ac_no;
           DB::table('ed_users')
           ->where('member_no','=',$member_no) 
           ->update(['status'=>1]);
           DB::table('ed_classinfo')
           ->where('teacher_ac_no','=',$member_no) 
           ->update(['school_id'=>$school_id]);
           return $teacher_ac_no;
      }


     
      
      //*** For Get teacher's mail Id ***/
      public function update_status($id){
        $teacher_ac_no = DB::table('ed_school_teacher_request')
        ->select('ed_school_teacher_request.teacher_ac_no')
        ->where('id','=',$id)
        ->first();
        $teacher_mail = DB::table('ed_users')
        ->select('email')
        ->where('member_no','=',$teacher_ac_no->teacher_ac_no)
        ->first();
       return $teacher_mail->email;
     }

      public function delete_teacher_status($id){
         //var_dump($id);die();
         $teacher_ac_no = DB::table('ed_school_teacher_request')
           ->where('id',$id) 
           ->update(['status'=>0]);
         
           $member_no = DB::table('ed_school_teacher_request')
           ->select('teacher_ac_no','school_id')
           ->where('id','=',$id)
           ->first();
           $school_id = $member_no->school_id;
           $member_no = $member_no->teacher_ac_no;
           DB::table('ed_users')
           ->where('member_no','=',$member_no) 
           ->update(['status'=>'-1']);
          // DB::table('ed_classinfo')
           //->where('teacher_ac_no','=',$member_no) 
           //->update(['school_id'=>0);
           //return $teacher_ac_no;
      }
}
