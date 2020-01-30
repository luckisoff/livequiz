@extends('layouts.admin')

@section('title', $ad?'Update ad':'Create ad')

@section('content-header',  $ad?'Update ad':'Create ad')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>home</a></li>
    <li class="active"><i class="fa fa-camera"></i>{{$ad?'Update':'Create'}} ad</li>
@endsection

@section('content')

    <div class="row">

    @include('notification.notify')
    
    <div class="col-md-12">
        <div class="nav-tabs-custom">

                <ul class="nav nav-tabs">
                    <!-- <li class="active"><a href="#general" data-toggle="tab">General</a></li> -->
                </ul>
               
                <div class="tab-content">
                   
                    <div class="active tab-pane" id="general">
                      
                        <form id="form-upload" action="{{route('admin.ad.store',$ad?$ad:'')}}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Name *</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter ad name" value="{{$ad?$ad->name:''}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Banner *</label>
                                        <input type="file" name="banner" class="form-control" id="banner">
                                    </div>
                                    @if($ad)
                                    <img src="{{$ad->banner}}" alt="{{$ad->name}}" class="img-responsive" style="width:50px">
                                    @endif
                                </div><br>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Video Link *</label>
                                        <input type="text" name="video" class="form-control" id="video" value="{{$ad?$ad->video:''}}" placeholder="Enter video link">
                                    </div>
                                </div>

                          </div>
                          <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{$ad?'Update':'Create'}}</button>
                        </div>
                        </form>

                          
                    </div>
                </div>

            </div>
           
        </div>
</div>
    </div>
@endsection