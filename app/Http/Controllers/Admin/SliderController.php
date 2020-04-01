<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;    

use App\Http\Controllers\Controller;
use App\Models\SliderModel as MainModel;

class SliderController extends Controller
{
    private $pathViewController = 'admin.pages.slider.';
    private $controllerName = 'slider';
    private $model;

    // chia sẽ view ra tất cả các trang 
    public function __construct()
    {   $this->model = new mainModel();
        view()->share('controllerName', $this->controllerName);
    }

    // trang index không cần id
    public function index()
    {
         
        $items = $this->model->listItems(null,['task'=>'admin-list-items']);
        $itemsStatus = $this->model->countItems(null,['task'=>'admin-count-items']);
        echo '<pre>'; 
        print_r($itemsStatus);
        echo '</pre>';
        return view($this->pathViewController. 'index',[
           'items'=>$items,
           'itemsStatus'=>$itemsStatus,

        ]);
    }


    
  
}