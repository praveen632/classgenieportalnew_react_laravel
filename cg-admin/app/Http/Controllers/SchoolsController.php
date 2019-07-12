<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\cms_schools;
use Illuminate\Pagination\LengthAwarePaginator;
use Session;

class SchoolsController extends Controller
{
  /****** Display a listing of class Management *****/
  public function index()
  {
    return view('schools.index');
  }
  public function schools_list(Request $request)
  {

          $sort = $request['sort_by'];
          $req = $request->all();         
          $obj_content = new cms_schools();
          $rst_email_contents = $obj_content->getdata($req);
          $html = $this->get_html($rst_email_contents['rst'],$sort);
          echo  $rst_email_contents['total_num_entries'].'~'.$html;           
  }
 

  /****** Show the form for creating a new class ******/
  public function create()
  {
    return view('schools.create');
  }

  /****** Store a newly created class *****/
  public function store(Request $request)
  {
    $validator = $this->validate($request, [
      'school_name' => 'required',
      'address' => 'required',
      'city' => 'required',
      'state' => 'required',
      'country' => 'required',
      'pincode' => 'required|numeric',
      'email_id' => 'required|email',
      'phone' => 'required|numeric|digits_between:9,12',
      //'status' => 'required',
      ]);
    $req = new cms_schools();
    $insert = $req->adddata($request);
    if($insert ==1){
      Session::flash('message', 'Record is inserted!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('schools'); 
  }



  /****** Show the form for edit class.******/
  public function edit($school_id)
  {
    $req = new cms_schools();
    $edit = $req->editdata($school_id);
    return view('schools.edit',compact('edit'));
  }

  /****** Update the specified class. ******/
  public function update(Request $request, $school_id)
  { 
   $validator = $this->validate($request, [
      'pincode' => 'required|numeric',
      'email_id' => 'required|email',
      'phone' => 'required|numeric|digits_between:9,12',
      //'status' => 'required',
      ]);
     $req  = new cms_schools();
     $email = $req->updatedata($request, $school_id);
     count($email);
    if(count($email) > '0'){
    if($email[0]->status == '-1'){
      $mail = $this->disableemail($email);
      Session::flash('message', 'Record Updated!');
    }else{
       $mail = $this->approveemail($email);
      Session::flash('message', 'Record Updated!');
    }
   }
    return redirect('schools');
  }

 public function disableemail($email){ 

     $arr = (array) json_decode(json_encode($email),true); 
     $arr1 = array();
      foreach ($arr as $val) { 
          $arr1[] = $val['email'];
       }
       if($arr1){
          $email = implode(',', $arr1);
          executeCurlBasic(web_url.'?token=aforetechnical@321!&id=19','email='.$email, 'POST');
       }    
      
 }

 public function approveemail($email){ 
     $arr = (array) json_decode(json_encode($email),true); 
     $arr1 = array();
      foreach ($arr as $val) { 
          $arr1[] = $val['email'];
       }
       if($arr1){
          $email = implode(',', $arr1);
         // echo web_url.'?token=aforetechnical@321!&id=8';
          executeCurlBasic(web_url.'?token=aforetechnical@321!&id=20','email='.$email, 'POST');
       }    
      
 }

  /****** Remove the specified class ******/
  public function destroy($school_id)
  {
    $req  = new cms_schools();
    $email = $req->deletedata($school_id);
    if($email){
     $mail = $this->disableemail($email);
      Session::flash('message', 'Record Updated!'); 
    }else{
      Session::flash('message', 'Database Error!');
    }
    //return redirect('schools/list');
    return true;
  }

  public function update_school(Request $request){ 
  $id = $request['school_id'];
  $req = new cms_schools();
  return $teachermail = $req->update_school($id);
}

public function get_email(Request $request){  
  $id = $request['id'];
  $req = new cms_schools();
  return $teachermail = $req->get_email($id);
}
public function sendmail($email){ 
  $url =  web_url.'?email='.$email.'&id=8&token=aforetechnical@321!';
  print_r($url);
    executeCurlBasic($url,'');
 }

 public function views($school_id)
  {     
          $req = new cms_schools();
          $viewdetails = $req->viewDetails($school_id);
          $html = $this->get_view_school_html($viewdetails);
          echo $html;           
  }

function get_html($rst_email_contents,$sort){
              ob_start();
            ?>
   <table class="table table-striped overflow-new">
            <thead>
              <?php   
              if(count($rst_email_contents) > 0){?>
              <tr>
                <th>S.NO</th>
                <th>School Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Status</th>
                <th>Details</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php  
              $i = 1; 
              foreach($rst_email_contents as $row)
              {
              ?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $row->school_name?></td>
                  <td><?php echo $row->address?></td>
                  <td><?php echo $row->city?></td>
                  <td><?php if($row->status==0){?><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".<?php echo $row->school_id;?>"  onclick=getApproved(<?php echo $row->school_id;?>) >Approve</button><?php }elseif($row->status==1){?><button type="button" class="btn btn-success" disabled="disabled" data-toggle="modal" >Approved</button>
                  <?php }elseif ($row->status == -1) {?><button type="button" class="btn btn-warning" disabled="disabled" data-toggle="modal" >Disabled</button><?php }elseif ($row->status == 2) {?><button type="button" class="btn btn-danger" disabled="disabled" data-toggle="modal" >Deleted</button><?php }?>
                   </td>
                  <div id="ttt" class="modal fade yes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" id ="status_yes" style="padding: 50px;">        
                </div>               
              </div>
            </div>
                <td>
                 <span class="col-md-1">
                    <button type="submit" class="btn btn-success" data-toggle="modal" data-target=".<?php echo $row->school_id;?>"  onclick=views(<?php echo $row->school_id;?>) >Views</button>                    
                  </span>
                  </td>
                 <td>
                    <span class="col-md-1">
                    <a href="<?php echo url('/schools/'.$row->school_id.'/edit') ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                    </span><span class="col-md-1">
                      <?php if($row->status == 2){ ?>
                    <button type="submit" class="btn btn-danger" data-toggle="modal" disabled="disabled" data-target=".<?php echo $row->school_id;?>"  onclick=destroy(<?php echo $row->school_id;?>) >Delete</button>  </span>
                    <?php }else{ ?>  
                      <button type="submit" class="btn btn-danger" data-toggle="modal" data-target=".<?php echo $row->school_id;?>"  onclick=destroy(<?php echo $row->school_id;?>) >Delete</button>  </span>
                    <?php } ?>                
                  </span>
                </tr>
                <?php $i++;} ?>
                <?php }else{ ?>
                <tr><td style="background-color: #ddd; text-align: center; font-weight: bold;">Record Not Found</td></tr>
                <?php } ?>
              </tbody>
            </table><?php
             $strHtml = ob_get_contents();
            ob_end_clean();
          return $strHtml;
      }


     function get_view_school_html($viewData){
              ob_start();
            ?>
  <div class="panel-heading"><span style="font-size:15px;">Add Schools &nbsp;&nbsp;</span><a class="btn btn-success search_btn-add  add_newbtn" href="<?php echo url('/schools')?>">View List</a></div>       
   <table class="table table-striped overflow-new">
          
              <?php   
              if(count($viewData) > 0){
                ?>
              <tr>                
                <th>School Name</th>
                <td><?php echo $viewData->school_name;?></td>                
              </tr> 

               <tr>                
                <th>Web Url</th>
                <td><?php echo $viewData->web_url;?></td>              
              </tr> 

               <tr>                
                <th>Email Id</th>
                 <td><?php echo $viewData->email_id;?></td>             
              </tr> 

               <tr>                
                <th>Address</th>
                 <td><?php echo $viewData->address;?></td>               
              </tr> 

               <tr>                
                <th>City</th>
                 <td><?php echo $viewData->city;?></td>                
              </tr> 

                <tr>                
                <th>State</th>
                 <td><?php echo $viewData->state;?></td>                
              </tr> 
               
                 <tr>                
                <th>Country</th>
                  <td><?php echo $viewData->country;?></td>                
              </tr>

              <tr>                
                <th>Pincode</th>
                 <td><?php echo $viewData->pincode;?></td>                 
              </tr>

              <tr>                
                <th>Phone</th>
               <td><?php echo $viewData->phone;?></td>          
              </tr> 

              <?php } ?>
                 
            </table>

            <?php 
             $strHtml = ob_get_contents();
            ob_end_clean();

          return $strHtml;
      }


    }
 



