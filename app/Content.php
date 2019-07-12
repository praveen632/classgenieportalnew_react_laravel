<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Content extends Model
{
  protected $table = ED_CONTENT;
	public function getIndex(){
	$user = DB::table(ED_CONTENT)->where('id', '1')->get();
    return $user;
    }

    public function getAbout(){
    	$user = DB::table(ED_CONTENT)->where('id', '2')->get();
        return $user;
    }

    public function getFeatures(){
    	$user = DB::table(ED_CONTENT)->where('id', '3')->get();
        return $user;
    }

    public function getnewsletter($data){
       $datas = '';       
       $user = DB::table(ED_NEW_LETTER)->where('email', $data)->get();
       $id = count($user);       
           if($id < '1'){
            $dd = date('y-m-d H:i:s');
            DB::table(ED_NEW_LETTER)->insert(
                    ['email' => $data, 'created_at' => $dd ]
                );
              $datas['success_msg'] = "Thank you for subscribe";
           }else{
              $datas['success_msg'] = "You are allready subscribed";
           }
        return $datas;
    }

    public function getContact(){
      $user = DB::table(ED_CONTENT)->where('id', '5')->get();
      return $user;
    }

    public function getContactus($data){
           $email = $data['email'];
           $user = DB::table(ED_CONTACTUS)->where('email', $email)->get();
           $id = count($user);       
               if($id < '1'){
                $data['created_at'] = date('y-m-d H:i:s');
                DB::table(ED_CONTACTUS)->insert($data);
                  $datas['success_msg'] = "Thank you for Contact";
               }else{
                  $datas['success_msg'] = "You are allready Contact";
               }
            return $datas;
     }

     public function getPrivecy($data){
        $user = DB::table(ED_CONTENT)->where('id', '6')->get();
        return $user;
     }

     public function getTerms($data){
        $user = DB::table(ED_CONTENT)->where('id', '7')->get();
        return $user;
     }

}