<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\cms_teacherlist;
use Session;

class TeacherlistController extends Controller
{
  /****** Display a list *****/
  public function show()
  {
    return view('teacherlist.teacherlist');
  }

  public function listdata(Request $request){

   // 	$req = new cms_teacherlist();
  	// $teacherlist = $req->get_teacher_list($school_name);
   //  $html = $this->generateHtml($teacherlist);   
   //  echo $html; 
  	// }

          $sort = $request['sort_by'];
          $req = $request->all();
          $reqs = new cms_teacherlist();

          $teacherlist = $reqs->get_teacher_list($req); 
          // $count = $teacherlist['total_num_entries']; 

          // $html = $this->generateHtml($teacherlist['rst'],$sort);
          // echo  $count.'~'.$html;    

          $html = $this->generateHtml($teacherlist['rst'],$sort);
          echo  $teacherlist['total_num_entries'].'~'.$html; 
}
public function update_status(Request $request){
   $id= $request['id'];
  $req = new cms_teacherlist();
  return $teachermail = $req->update_status($id);  
}

 public function update_teacher_status($id){

   $req = new cms_teacherlist();
  return $school_status = $req->update_teacher_status($id);

 }

 
 public function delete_teacher_status($id){ 
   $req = new cms_teacherlist();
  return $school_delete = $req->delete_teacher_status($id);
 } 

 public function sendmail($email){ 
   $url =  web_url.'?email='.$email.'&id=7&token=aforetechnical@321!';
   executeCurlBasic($url,'');
 }

 public function sendmaildelete($email){ 
   $url =  web_url.'?email='.$email.'&id=18&token=aforetechnical@321!';
    executeCurlBasic($url,'');
 }
 
function generateHtml($teacherlist, $sort){
            if(empty($teacherlist)){?>
            <div class="alert alert-info" role="alert"><center><b>No Content Found</b></center></div>
            <?php }
            else {  ob_start();?>
            <table class="table table-striped">
                <thead>
                   <tr>                      
                       <th>School Name</th>
                       <th>Teacher Name</th>
                       <th> Status                                  
                       </th>
                       </tr>
                </thead>
                <?php
                  foreach($teacherlist as $value){
                  ?>
                   <tr>
                      <td><?php echo $value->school_name;?></td>
                      <td><?php echo $value->name;?></td>
                      <td id="<?php echo $value->id;?>" ><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".<?php echo $value->id;?>"  onclick=getApproved(<?php echo $value->id;?>)>Approve</button>

                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target=".<?php echo $value->id;?>"  onclick=getDelete(<?php echo $value->id;?>)>Delete</button>

                      </td>  </tr><?php } ?> </table>
            <div id="ttt" class="modal fade yes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" id ="status_yes" style="padding: 50px;">        
                </div>               
              </div>
            </div>                         
            <?php         
            $strHtml = ob_get_contents(); 
            ob_end_clean();
          return $strHtml;
        }
      }
}