@php
    
use App\Helpers\Template;

@endphp
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
         {{--  --}}
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th class="column-title">#</th>
                                <th class="column-title">Slider Info</th>
                                <th class="column-title">Trạng thái</th>
                                <th class="column-title">Tạo mới</th>
                                <th class="column-title">Chỉnh sửa</th>
                                <th class="column-title">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if (count($items) > 0)

                           @foreach ($items as $key=>$val)
                           @php
                               $stt              = $key +1;
                               $id               = $val['id'];
                               $name             = $val['name'];
                               $description      = $val['description'];
                               $link             = $val['link'];
                               $showCreated      = Template::showCreatedHistory($val['created'],$val['created_by']);
                               $showModified     = Template::showCreatedHistory($val['modified'],$val['modified_by']);
                               $showThumb        = Template::showThumbSlider($val['thumb'],$val['name'],$controllerName);
                               $showButtonStatus = Template::showButtonAction($controllerName,$id,$val['status']);
                               $showButtonAction = Template::showButtonEdit($id,$controllerName);
                           @endphp
                              <tr class="odd pointer">
                                <td>{{ $stt }}</td>
                                <td width="40%">
                                    <p><strong>Name:</strong>{{ $name }}</p>
                                    <p><strong>Description:</strong> {{  $description }}</p>
                                    <p><strong>Link:</strong> {{ $link }}</p>
                                    {!! $showThumb !!}
                                </td>
                                <td>{!! $showButtonStatus !!}</td>
                                <td>
                                   {!! $showCreated !!}
                                </td>
                                <td>
                                    {!! $showModified !!}
                                </td>
                                <td class="last">
                                  {!!$showButtonAction !!}
                                </td>
                            </tr>
                           @endforeach
                          

                           
                            @else
                            <tr>
                                <td colspan="6" class="text-center">
                                    Dữ Liệu Đang Được Cập Nhật !!
                                </td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>