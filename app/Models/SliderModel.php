<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderModel extends Model
{
	protected $table = 'slider';
	public $timestamps = false;
	const CREATED_AT = 'creation_date';
	const UPDATED_AT = 'last_update';


	public function listItems($params,$options){
		$result = null;
		if ($options['task'] == 'admin-list-items') {
			 $result = self::select('id','name','description','link','thumb','status','created','created_by','modified','modified_by')
			// ->where('id', '>', 3)
			->get(); 
		}
		return $result;
	}
}