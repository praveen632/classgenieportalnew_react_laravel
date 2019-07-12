<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\emailContent;
use DB;
use Validator;
use Session;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Pagination\LengthAwarePaginator;

class EmailContentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function saveData(Request $request)
    { 
   
      $data = array('id' =>$request->id,
                   'type'=>$request->type12,
                   'from_email' =>$request->from_email,
                   'subject' =>$request->subject,
                   'editor1' =>$request->editor1,
                   'editor2' =>$request->editor2,
                   'status'=>$request->status,
                   'created_at' => date('Y-m-d H:i:s'),
                   'updated_at' => date('Y-m-d H:i:s'));
                    $req = new emailContent();
                    $result = $req->saveEmailData($data);
                    if($result==1)
                    {
                      Session::flash('message', 'Record Inserted!');
                      return redirect('emaillist');
                    }
                  }

     //function execute onload 
     public function showData(Request $request)
     {   

         $sort = $request['sort_by'];
          $req = $request->all();
          $obj_content = new emailContent();
          $rst_email_contents = $obj_content->getEmailContent($req);
          $html = $this->genrateHtml($rst_email_contents['rst'],$sort);
          echo $rst_email_contents['total_num_entries'].'~'.$html;
     }
     
     //function execute on click of export
     public function export(Request $request){
        $req = $request->all();
        $obj_content = new emailContent();
        $rst_email_contents = $obj_content->getEmailContent(array('id'=>$req['hid_export_id'], 'type'=>$req['hid_export_type'], 'subject'=>$req['hid_export_subject']), false);
        if($req['typeExp'] == 'pdf'){
             $html = $this->genratePdfHtml($rst_email_contents['rst']);
             genratePdfReport($html);
        }
        if($req['typeExp'] == 'csv'){
             genrateCsv(['ID', 'Type', 'Subject'],$rst_email_contents['rst']);
        }
     }

   public function editData($id){
      if($id=='new')
       {
          $data = array('id'          => '',
                'page_name'   => '',
                'description' => '',
                'title'       => '',
                'url'         => '');
         return view('contentManagement.editor')
         ->with('data',$data);
         }else{ 
             $req = new emailContent;
             $res = $req->getEditContent($id);
             if($res != '0')
             {
             $data = array(
                     'id'          => $res[0]->id,
                     'type'        => $res[0]->type,
                     'from_email'  => $res[0]->from_email,
                     'subject'     => $res[0]->subject,
                     'body'        => htmlentities($res[0]->body),
                     'feature'     => htmlentities($res[0]->feature),
                     'status'      => $res[0]->status);             
             return view('emailmanagement.email')
             ->with('item',$data);
             }
          }
      }

      function genrateHtml($rst_email_contents,$sort){
            ob_start();
            if(empty($rst_email_contents)){
            ?>
            <div class="alert alert-info" role="alert"><center><b>No Content Found</b></center></div>
            <?php
            }
            else
            {
            ?>
            <table class="table table-striped">
                <thead>
                   <tr>
                       <th>ID</th>
                       <th>Type</th>
                       <th>Subject</th>
                       <th>Status<a href="javascript:void(0);"><?php if($sort == 'A'){ ?><span id="sort_icon" aria-hidden="true" class="glyphicon glyphicon-triangle-bottom" title="Up" onclick="sortData()"><?php }else if($sort == 'D'){?><span id="sort_icon" aria-hidden="true" class="glyphicon glyphicon-triangle-top" title="Down" onclick="sortData()"><?php }?></span></a>                    
                       </th>
                       <th>Modify</th>
                   </tr>
                </thead>
                <?php
                  foreach($rst_email_contents as $value){
                  ?>
                   <tr id="<?php echo $value->id;?>"><td class="page" style="display:none"><?php echo $value->id;?></td>
                      <td><?php echo $value->id;?></td>
                      <td><?php echo $value->type;?></td>
                      <td><?php echo $value->subject;?></td>
                      <td><?php if($value->status==1){ ?> <img src="<?php echo url('/')?>/images/activepage.gif" height="20" width="20"/><?php } else {  ?> <img src="<?php echo url('/')?>/images/inactivepage.gif" height="20" width="20"/> <?php } ?></td>
                      <td id="<?php echo $value->id;?>" onclick="editEmailContent(this.id)"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
                  </tr>
                  <?php
                  }
                ?>
            </table>
            <?php
          }
          $strHtml = ob_get_contents();
          ob_end_clean();
          return $strHtml;
      }

      function genratePdfHtml($rst_email_contents){
            ob_start();
            if(empty($rst_email_contents)){
            ?>
            <div class="alert alert-info" role="alert"><center><b>No Content Found</b></center></div>
            <?php
            }
            else
            {
            ?>
            <table class="table table-striped">
                <thead>
                   <tr>
                       <th><b>ID</b></th>
                       <th><b>Type</b></th>
                       <th><b>Subject</b></th>
                   </tr>
                </thead>
                <?php
                  foreach($rst_email_contents as $value){
                  ?>
                   <tr id="<?php echo $value->id;?>"><td class="page" style="display:none"><?php echo $value->id;?></td>
                      <td><?php echo $value->id;?></td>
                      <td><?php echo $value->type;?></td>
                      <td><?php echo $value->subject;?></td>
                  </tr>
                  <?php
                  }
                ?>
            </table>
            <?php
          }
          $strHtml = ob_get_contents();
          ob_end_clean();
          return $strHtml;
      }    
}