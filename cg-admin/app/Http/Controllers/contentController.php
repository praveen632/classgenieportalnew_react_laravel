<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests;
use App\content;
use DB;
use Validator;
use Session;
class contentController extends Controller
{
  public function saveEditor(Request $request)
  {
   $data = array('id'         =>$request->id,
               'description'=>$request->editor1,
               'title'      =>$request->page_title,
               'page_name'  =>$request->page_name,
               'url'        =>$request->page_url,
               'metakey'    =>$request->text1,
               'metadesc'   =>$request->text2,
               'created_at' => date('Y-m-d H:i:s'),
               'updated_at' => date('Y-m-d H:i:s'));
    $req = new content();
    $res = $req->editContent($data);
    if($res == 1)
    {
      Session::flash('message', 'Record Updated!');
      return redirect('contentlist');
    }else{
      return view('contentManagement.contentListing')->with('data',$data);
    }
  }
  public function getContentData()
    {
     $where = ''; 
     $res = new content();
     $req = $res->getData($where);
     if($req != '0')
     { 
     return view('contentManagement.contentListing')
     ->with('data',$req);
   }else{
     return view('contentManagement.contentListing')->with('data',$req);
    }
   }
       
public function getData($id)
    { 

    	if($id=='new')
    	 {
          $data = array('id'  => '',
				        'page_name'   => '',
				        'description' => '',
				        'title'       => '',
				        'url'         => '',
                'metakey'     => '',
                'metadesc'    => '');
         return view('contentManagement.editor')
         ->with('data',$data);
         }else
         $req = new content;
	       $res = $req->getEditContent($id);
	       if($res != '0'){
          $data = array(
             'id'          => $res[0]->id,
  		       'page_name'   => $res[0]->page_name,
  		       'description' => htmlentities($res[0]->description),
             'metakey'     => $res[0]->metakey,
             'metadesc'    => $res[0]->metadesc,
  		       'title'       => $res[0]->title,
  		       'url'         => $res[0]->url);
       return view('contentManagement.editor')
	     ->with('data',$data);
     }
   }

public function deleteContent($id)
{
  $res = DB::table('cms_content')->where('id', '=', $id)->delete();
  if($res){
    return redirect('contentlist');
  }
}

public function getSearchData($where)
{
  if($where != 'list')
  {
  $param = explode(',', $where);
}else{
  $param = array('0' =>'','1' =>'','2'=>'');
} 
$res = new content();
$req = $res->getData($where);
if($req != '0')
{          
  echo $head =  '<table class="table table-striped" id="datatable"><tr><tr><th>Sr No.</th><th>Page Name</th><th>Page Title</th><th>Page Url</th><th>Action</th></tr><tr><th></th><th><input type="text" id="name" placeholder="Search By Name" onchange="getsearchData()" value="'.$param[0].'"></th><th><input type="text" id="title" placeholder="Search By Title" onchange="getsearchData()" value="'.$param[1].'"></th><th><input type="text" id="url" placeholder="Search By Url" onchange="getsearchData()" value="'.$param[2].'"></th></tr></tr>';
      $i=1;
       foreach ($req as $key => $value)
        {        
          $table = '<tr id="'.$value->id.'"><td class="page" style="display:none">'.$value->id.'</td>
         <td>'.$i.'</td>
         <td>'.$value->page_name.'</td>
         <td>'.$value->title.'</td>
         <td>'.$value->url.'</td>
           <td id="'.$value->id.'" onclick="editContent(this.id)"><a href="#"><span class="glyphicon glyphicon-pencil"></span></a></td>
           <td id="'.$value->id.'" onclick="deleteContent(this.id)"><button><span class="glyphicon glyphicon-trash"></span></button></td>
           </tr>';
         echo $table;  
         $i++;
        }
        echo '</table>';        
      }else{
        echo $head =  '<table class="table table-striped" id="datatable"><tr><tr><th>Sr No.</th><th>Page Name</th><th>Page Title</th><th>Page Url</th><th>Action</th></tr><tr><th></th><th><input type="text" id="name" placeholder="Search By Name" onchange="getsearchData()"></th><th><input type="text" id="title" placeholder="Search By Title" onchange="getsearchData()"></th><th><input type="text" id="url" placeholder="Search By Url" onchange="getsearchData()"></th></tr></tr>';   
        echo '<div class="alert alert-info" role="alert"><center><b>No Content Found</b></center></div>'.'</table>';
       }
     }
   }
