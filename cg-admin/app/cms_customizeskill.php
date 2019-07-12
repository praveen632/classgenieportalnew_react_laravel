<?php
namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
class cms_customizeskill extends Model
{
	protected $table = ED_CUSTOMIZESKILL;
	public function getdata(){		
		return $imagemang = DB::table(ED_CUSTOMIZESKILL)->where('class_id', '=', 0)->get();		
	}

	public function adddata($request){
		$target_dir = base_path().'/public/assets/skill/';
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$img = $_FILES["image"]["name"];
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if(isset($_POST["image"]) AND ($_POST["image"] == "image")) {
			$check = getimagesize($_FILES["image"]["tmp_name"]);
			if($check !== false) {
				echo "image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		if (file_exists($target_file))
		{
			echo "file already exists.";
			$uploadOk = 0;
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			echo "only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		echo "your file was not uploaded.";
	} else {
		$insert = DB::table(ED_CUSTOMIZESKILL)->insert(array('name'=>$request->name, 'pointweight'=>$request->pointweight,  'class_id'=>'0', 'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')));
		if($insert){
			$select =  DB::table(ED_CUSTOMIZESKILL)->orderBy('id','DESC')->first();
			$update = DB::table(ED_CUSTOMIZESKILL)->where('id',$select->id)->update(array('image'=>$select->id.'_'.$img,'updated_at'=> date('Y-m-d H:i:s')));
			$target_file1 = $target_dir . $select->id.'_'.basename($_FILES["image"]["name"]);
			if($update){
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file1)) {
					echo "The file has been uploaded.";
				} else {
					echo "there was an error uploading your file.";
				}
				return 1;
			}else{
				return 0;
			}
		}else{
			return 0;
		}
	} 
}

public function editdata($id){
	$edit = DB::table(ED_CUSTOMIZESKILL)->where('id', $id)->first();
	$count = count($edit);
	if($count > 0)
	{
		return $edit;
	}
	else
	{
		return 0; 
	}
}

public function updatedata($request, $id ){
	if($request->image1 != ""){
		$target_dir = base_path().'/public/assets/skill/';
		$target_file = $target_dir . basename($_FILES["image1"]["name"]);
		$img = $_FILES["image1"]["name"];
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		if (file_exists($target_file))
		{
			echo "file already exists.";
			$uploadOk = 0;
		}
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			echo "only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	if($uploadOk == 0) {
		echo "your file was not uploaded.";
	}else{
		$update = DB::table(ED_CUSTOMIZESKILL)->where('id',$id)->update(array('image'=>$id.'_'.$img,'name'=>$request->name, 'pointweight'=>$request->pointweight, 'updated_at'=> date('Y-m-d H:i:s')));
		unlink($target_dir.$request->image);
		$target_file1 = $target_dir . $id.'_'.basename($_FILES["image1"]["name"]);
		if($update){
			if (move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file1)) {
				echo "The file has been uploaded.";
			} else {
				echo "there was an error uploading your file.";
			}
			return 1;
		}
	}
}else{
	$update = DB::table(ED_CUSTOMIZESKILL)->where('id',$id)->update(array('name'=>$request->name, 'pointweight'=>$request->pointweight, 'updated_at'=> date('Y-m-d H:i:s')));
	if($update){
		return 1;
	}else{
		return 0;
	}
}
}

public function deletedata($id){
	$target_dir = base_path().'/public/assets/skill/';
	$delete = DB::table(ED_CUSTOMIZESKILL)->where('id', $id)->first();
	if($delete){
        unlink($target_dir.$delete->image);
		$res = DB::table(ED_CUSTOMIZESKILL)->where('id', '=', $id)->delete();
		if($res){			
			return 1;
		}		
	}else{
		return 0;
	}
}
}

