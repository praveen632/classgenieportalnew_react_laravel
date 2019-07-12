<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Content;
use Auth;
include(base_path() . '/include/function.php'); 

class WelcomeController extends Controller
	{
		  public function index(Request $request){		  	
             $req = $request->all();         
             $obj_content = new Content();
             $datas = $obj_content->getIndex($req);
             $value = $request->session()->get('key');
             return view('welcome', compact('datas', 'value'));
		}

		public function about(Request $request){
             $req = $request->all();         
             $obj_content = new Content();
             $datas = $obj_content->getAbout($req); 
             $value = $request->session()->get('key');           
             return view('sections.about', compact('datas', 'value'));
		}

		public function features(Request $request){
             $req = $request->all();         
             $obj_content = new Content();
             $datas = $obj_content->getFeatures($req);
             $value = $request->session()->get('key');            
             return view('sections.features', compact('datas', 'value'));
		}

		public function newsletter(Request $request){
                 	$data= $_GET['email'];
                  $obj_content = new Content();
                  $datas = $obj_content->getnewsletter($data);
                  if($datas['success_msg'] == 'You are allready subscribed'){
                      return $datas;
                  }else{
                    $this->mail($data);
                    return $datas;   
                  }
		}

    public function mail($data){                                        
           $url =  web_url.'?email='.$data.'&id=13&token=aforetechnical@321!';
           executeCurlBasic($url,'');
           return true;
    }

    public function contact(Request $request){
             $req = $request->all();         
             $obj_content = new Content();
             $datas = $obj_content->getContact($req);
             $value = $request->session()->get('key');            
             return view('sections.contact', compact('datas', 'value'));
    }

    public function contactus(Request $request){
             $data = array(
                'email' => $_GET['email'],
                'name' => $_GET['fullname'],
                'message' => $_GET['message'], 
              );
             $obj_content = new Content();
             $datas = $obj_content->getContactus($data);
              if($datas['success_msg'] == 'You are allready Contact'){
                  return $datas;
              }else{
                $this->mailContactus($data);
                return $datas;   
              }
    }

    public function mailContactus($data){
           $email = $data['email'];
           $url =  web_url.'?email='.$email.'&id=2&token=aforetechnical@321!';
           executeCurlBasic($url,'');
           return true;
    }

     public function privecy(Request $request){       
             $req = $request->all();         
             $obj_content = new Content();
             $datas = $obj_content->getPrivecy($req);
             $value = $request->session()->get('key');
             return view('sections.privecy', compact('datas', 'value'));
    }

     public function terms(Request $request){       
             $req = $request->all();         
             $obj_content = new Content();
             $datas = $obj_content->getTerms($req);
             $value = $request->session()->get('key');
             return view('sections.terms', compact('datas', 'value'));
    }
	}
?>