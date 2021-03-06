<?php 

namespace App\Helpers;
use Config;

class Template
{
	public static function showCreatedHistory($time,$by){
		$xhtml = '';
		$xhtml =sprintf('<p><i class="fa fa-user"></i>%s</p>
			<p><i class="fa fa-clock-o"></i>%s</p>',$by,$time);
		return $xhtml;
	}	


	//Hiển thị ảnh
	public static function showThumbSlider($NameThumb,$NameAlt,$controllerName){
		$xhtml = '';
		$xhtml =sprintf('<img src="%s" alt="%s" class="zvn-thumb">',asset('images/'.$controllerName.'/'.$NameThumb),$NameAlt);
		return $xhtml;
	}
	//Hiển thị nút kích hoạt, chưa kích hoạt
	public static function showButtonAction($controllerName,$id,$status){

				//định nghĩa thêm tham số cho buttonAction
		$tmplButton = Config::get('zvn.template.status');
		//Khi người dùng chọn nút hiện tại 
		$currentButton = $tmplButton[$status];
		$link = route($controllerName.'/status',['status'=>$status,'id'=>$id]);
		$xhtml = '';
		$xhtml =sprintf('<a href="%s" type="button" class="btn btn-round %s">%s</a>',$link,$currentButton['class'],$currentButton['title']);
		return $xhtml;
	}

	public static function showButtonEdit($id,$controllerName){
		//định nghĩa các thông tin của các nút 
		$tmplButtonEdit = [
			'edit'   =>['title'=>'Chỉnh sửa', 'class'=>'btn-success','icon'=>'fa-pencil','route-name'=>$controllerName.'/form'],
			'delete' =>['title'=>'Xóa', 'class'=>'btn-danger','icon'=>'fa-trash','route-name'=>$controllerName.'/delete'],

		];
		//định nghĩa các trang cần nhận những nút nào
		$optionOfPages  = [
			'slider'=>['edit','delete'],
			'default'=>['edit','delete','info'],

		];
		$controllerName = (array_key_exists($controllerName,$optionOfPages))? $controllerName :"default";
		$currentButtonEdit = $optionOfPages[$controllerName];//Đã dc chọn là slider

		$xhtml = '<div class="zvn-box-btn-filter">';
		foreach ($currentButtonEdit as  $value) {
			$ButtonAre = $tmplButtonEdit[$value];
			$link = route($ButtonAre['route-name'],['id'=>$id]);
			$xhtml .=sprintf('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip" data-placement="top" data-original-title="%s">
			<i class="fa %s"></i>
			</a>',$link,$ButtonAre['class'],$ButtonAre['title'],$ButtonAre['icon']);
		$xhtml .='</div>';
		}
		
		return $xhtml;
	}	

	//viết chức năng đổ buttonStatus
	public static function showButtonStatus($itemsStatus)
	{
		$xhtml = '';
		//muốn thêm 1 mảng vào đầu mảng 
		$all['status'] = 'All';
		$all['count'] = array_sum (array_column($itemsStatus,'count'));;
		array_unshift($itemsStatus,$all);
		$tmplButton = Config::get('zvn.template.status');


		if(count($itemsStatus) > 0){
			foreach ($itemsStatus as $item) {
				$currentStatus = $tmplButton[$item['status']];
				$itemOfStatus = $item['status'];
				$xhtml .= sprintf('<a href="?filter_status=all" type="button" class="btn btn-primary">
						%s <span class="badge bg-white">%s</span>
						</a>',$currentStatus['title'],$item['count']);
		
			}

		};
		
		return $xhtml;
	}


}


?>
