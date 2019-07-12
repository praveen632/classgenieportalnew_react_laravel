<?php
namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
DB::enableQueryLog();
class cms_teacherstatus extends Model
{
      //***For getting List of School Name and Teacher Name***/
      public function getdata(){
             return $data = DB::table('ed_schools')
             ->join('ed_schools', 'ed_schools.school_id')
             ->select('ed_schools.name', 'ed_schools.email_id')
             ->get();
      }
      //*** Getting School Name and Teacher Name on searching//
      public function get_teacher_status($school_name){

              if($school_name != ""){

      	                 $data = DB::table('ed_users')
                          ->join('ed_schools', 'ed_schools.school_id', '=', 'ed_users.school_id')
                          ->select('ed_users.name', 'ed_users.member_no','ed_users.email','ed_users.status', 'ed_schools.school_name')
                          ->where ('ed_schools.school_name','like',$school_name.'%')
                          ->where ('ed_users.status','=','1')
                          ->get();
                        }else{
                            $data = DB::table('ed_users')
                            ->join('ed_schools', 'ed_schools.school_id', '=', 'ed_users.school_id')
                            ->select('ed_users.name', 'ed_users.member_no','ed_users.email','ed_users.status', 'ed_schools.school_name')
                            ->where ('ed_users.status','=','1')
                            ->get();
                        } 
                     return $data; 
        }

      //*** For update the teacher status***/ 
        public function deactivate_teacher_status($member_no){
        	DB::table('ed_users')
           ->where('member_no',$member_no) 
           ->update(['status'=>-1]);

            DB::table('ed_classinfo')
           ->where('teacher_ac_no',$member_no) 
           ->update(['school_id'=>'0']);

           DB::table('ed_school_teacher_request')
           ->where('teacher_ac_no',$member_no) 
           ->update(['status'=>'0']);            

            $member_no = DB::table('ed_users')
            ->join('ed_schools', 'ed_schools.school_id', '=', 'ed_users.school_id')
            ->select('ed_schools.school_name')
            ->where('ed_users.member_no','!=',$member_no)
            ->first();
            $school_name = $member_no->school_name;
            if($school_name != ""){
            return $school_name;
          }else{
             return false;
          }
         }

      // //*** Getting School Name and Teacher Name on searching//
      // public function activate_teacher_status($member_no){
      // 	     DB::table('ed_users')
      //      ->where('member_no',$member_no) 
      //      ->update(['status'=>1]);            
      //       $member_no = DB::table('ed_users')
      //       ->join('ed_schools', 'ed_schools.school_id', '=', 'ed_users.school_id')
      //       ->select('ed_schools.school_name')
      //       ->where('ed_users.member_no','=',$member_no)
      //       ->first();
      //       $school_name = $member_no->school_name;
      //       return $school_name;          
      // }
}