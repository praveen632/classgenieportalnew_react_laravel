<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use Illuminate\Http\Request;
class TestingController extends Controller
{
     public function testAjax(Request $request){
     	$input = $request->all();
     	echo json_encode($input);
     }

     public function getData($id){
     	echo '<p>Hello '.$id.'<p>';
     }
}
?>