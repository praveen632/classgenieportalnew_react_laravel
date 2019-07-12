<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\cms_blogs;
use Session;

class BlogController extends Controller
{
  /****** Display a list *****/

public function index()
  {
    return view('blogManagement.blogListing');
  }

  /****** Show the form for creating a new blog ******/
  public function create()
  {
    return view('blogManagement.editor');
  }

   public function destroy($blog_id)
    {
      $req  = new cms_blogs();
      $delete = $req->deletedata($blog_id);
      if($delete == 1){
        Session::flash('message', 'Record Updated!'); 
      }else{
        Session::flash('message', 'Database Error!');
      }
      return redirect('bloglist');
    }

 public function edit($blog_id)
  {
    $req = new cms_blogs();
    $edit = $req->editdata($blog_id);
    return view('blogManagement.editblog',compact('edit'));
  }

  public function update(Request $request, $blog_id){ 
     $req  = new cms_blogs();
   $update = $req->updatedata($request, $blog_id);
    if($update == 1){
      Session::flash('message', 'Record Updated!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('bloglist');
  }

   public function blogs_list()
  {
    $req = new cms_blogs();
    $blogs = $req->getdata();
    $html = $this->get_html($blogs);
    echo $html; 
  }

   /****** Store a newly created Blog *****/
  public function saveblog(Request $request)
  {
     $data = array(
                   'description'=>$request->editor1,
                   'title'      =>$request->page_title,
                   'created_at' => date('Y-m-d H:i:s'),
                   'updated_at' => date('Y-m-d H:i:s'));
    $req = new cms_blogs();
    $res = $req->saveblog($data); 
    if($res == 1){
      Session::flash('message', 'Record Updated!');
    }else{
      Session::flash('message', 'Database Error!');
    }
    return redirect('bloglist');
  }
  
public function getData()
    {  
    	if($id=='new')
    	 {
          $data = array('id'  => '',
				        'description' => '',
				        'title'       => '');
         return view('blogManagement.editor')
         ->with('data',$data);
         }
         else            
	     $req = new content;
	     $res = $req->getEditContent($id);
	     if($res != '0')
	     {
	     $data = array(
               'id'          => $res[0]->id,
				       'description' => htmlentities($res[0]->description),
				       'title'       => $res[0]->title);
						return view('blogManagement.editor')
	    				 ->with('data',$data);
       }
    }

public function get_html($blogs){?>
   <table class="table table-striped">
            <thead>
              <?php   
              if(count($blogs) > 0){?>
              <tr>
                <th>S.NO</th>
                <th>Blog Title</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php  
              $i = 1; 
              foreach($blogs as $row)
              {
              ?>
                <tr>
                  <td><?php echo $i;?></td>
                  <td><?php echo $row->title?></td>
                  <div id="ttt" class="modal fade yes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" id ="status_yes">        
                </div>               
              </div>
            </div>                  
                  <td>
                    <span class="col-md-1">
                    <a href="<?php echo url('/bloglist/'.$row->id.'/edit') ?>"><i class="glyphicon glyphicon-pencil"></i></a>
                    </span><span class="col-md-1">

                    <button type="submit"  class="back_none"  data-toggle="modal" data-target=".<?php echo $row->id;?>"  onclick=destroy(<?php echo $row->id;?>) ><i class="glyphicon glyphicon-remove  delete_btn"></i></button>
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

}