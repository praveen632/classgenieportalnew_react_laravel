<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\cms_teacherstatus;
use Session;

class TeacherstatusController extends Controller
{
  /****** Display a list *****/
  public function show()
  {
      return view('teacherstatus.teacherstatus');
  }

  public function listdata(Request $request){
  	$school_name = $request['school_name'];
    $req = new cms_teacherstatus();
  	$teacherstatus = $req->get_teacher_status($school_name);
  	$html = $this->generateHtml($teacherstatus);
    echo $html;
  }

  public function deactivate_teacher_status(Request $request){
    $member_no= $request['member_no'];
    $req = new cms_teacherstatus();
    return $teacherstatus = $req->deactivate_teacher_status($member_no);
  }

// public function activate_teacher_status(Request $request){
//     $member_no= $request['member_no'];
//     $req = new cms_teacherstatus();
//     return $teacherstatus = $req->activate_teacher_status($member_no);
//   }

  function generateHtml($teacherstatus){
            if(empty($teacherstatus)){?>
            <div class="alert alert-info" role="alert"><center><b>No Content Found</b></center></div>
            <?php }
            else { ?>
            <table class="table table-striped">
                <thead>
                   <tr>                      
                       <th>Member Number</th>
                       <th>Name</th>
                       <th>Email Id</th>
                       <th>School Name</th>
                       </tr>
                </thead>
                <?php
                  foreach($teacherstatus as $value){

                  ?>
                   <tr>
                      <td><?php echo $value->member_no;?></td>
                      <td><?php echo $value->name;?></td>
                      <td><?php echo $value->email;?></td>
                      <td><?php echo $value->school_name;?></td>
                      <td id="<?php echo $value->member_no;?>" ><?php if($value->status >= '1'){?><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".<?php echo $value->member_no;?>"  onclick=getDeactivate(<?php echo $value->member_no;?>)>Deactivate</button><?php } ?>
                      </td> 
                       </tr> <?php } ?></table>
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