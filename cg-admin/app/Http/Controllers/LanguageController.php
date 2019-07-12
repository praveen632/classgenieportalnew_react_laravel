<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
class LanguageController extends Controller
{
	public function updatelanguage(Request $request){

		$validator = $this->validate($request, [
		   'menu_label' => 'required',
       'menu_key' => 'required',
        ]);
      $all= $request->all();
      $tempArray = array($request->menu_label=>$request->menu_key);
    /******* Get Language Json  ******/
      $url  = base_path().'/public/json/language.json';
  	  $data = file_get_contents($url);
  	  $data = json_decode($data,true);
	    foreach($data as $key => $value){
          if($key == $request->Language){
           	  $temp[$request->Language] = array_merge($value, $tempArray);
            	  }
       	  }
      $jsonData = ($temp);
      unset($data[$request->Language]);
      $arrayunset = $data;
      json_encode(array_merge($jsonData, $arrayunset));
      if($request->Language == "english"){
      file_put_contents($url, json_encode(array_merge($jsonData, $arrayunset)));
      }else{
      	file_put_contents($url, json_encode(array_merge($arrayunset, $jsonData)));
      }
      Session::flash('message', 'Record has been updated!');  
      return Redirect::to('/language');     
	}

/***** Dynamically Change Record Onchange event ******/
  public function languagechange(Request $request){
   $url  = base_path().'/public/json/language.json';
   $data = file_get_contents($url);
   $data = json_decode($data,true);
   foreach($data as $key => $value)
                    { 
                     if($key == $_POST['lang'])
                      {
                       foreach($value as $key1 =>$value1)
                       {
                 $langview[] =  '<div class="row form-group">';
                 $langview[] .=  '<div class="col-md-3"><label class="control-label">' .$key1.'</label></div>';  

                 $langview[] .=  '<div class="col-md-5"><input class="form-control" type="text" name="language[]" value="'. $value1.'"></div>';
                 $langview[] .=  '</div>';
                            
                 $langview[] .=  '</div>';
                           }
                        } 
                    }
       return ($langview);                     
  }
}