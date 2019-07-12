<?php
namespace App;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use DB;

class content extends Model
{
protected $table = ED_CONTENT;
public function editContent($data)
{
	if($data['id'] != '')
		{
			$req = DB::table(ED_CONTENT)
			->where('id', $data['id'])  // find your user by their email
			->limit(1)  // optional - to ensure only one record is updated.
			->update(array('url' => $data['url'],'description'=>$data['description'],'title'=>$data['title'],'metakey'=>$data['metakey'],'metadesc'=>$data['metadesc'],'page_name'=>$data['page_name'],'updated_at'=> date('Y-m-d H:i:s')));
		}else{
			$req = DB::table(ED_CONTENT)->insert($data);
		}
			if($req)
			return 1;
			else
			return 0;
	}

public function getData($where)
{
if($where == 'list')
{
	$where1 = '';
}else{
	$where = explode(',', $where);
	$where1 = 'WHERE';
	if($where[0] != '')
		{
			$where1 = $where1.'`page_name` LIKE '.'"%'.$where[0].'%"';
		}
		if($where[1] != '')
			{
				if($where[0] != '')
					{
						$where1 = $where1.'  AND ';
					}
					$where1 = $where1.'`title` LIKE '.'"%'.$where[1].'%"';
				}
				if( $where[2] != '')
					{
						if($where[1] != '')
							{
								$where1 = $where1.'  AND ';
							}
							$where1 = $where1.'`url` LIKE '.'"%'.$where[2].'%"';
						}
						if($where1 == 'WHERE  ')
							{
								$where1 = 'WHERE 1';
							}
						}
						
						$users = DB::select( DB::raw("SELECT * FROM `cms_content` ".$where1." ORDER BY id DESC"));
						$count = count($users);
						if($count > 0)
							{
								return $users;
							}else{
								return 0;
							}
						}

public function getEditContent($id)
{
	$data = DB::select( DB::raw("SELECT * FROM `cms_content` WHERE `id` = $id "));
	$data = DB::table(ED_CONTENT)->select('id','page_name','url','title','description','metakey','metadesc','status')->where('id','=',$id)->get();
	if(count($data) != 0)
		{
			return $data;
		}else{
			return 0;
		}
	}
}

