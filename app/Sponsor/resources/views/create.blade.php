@extends('layouts.admin')

@section('title', $sponsor?'Update sponsor':'Create sponsor')

@section('content-header',  $sponsor?'Update sponsor':'Create sponsor')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>home</a></li>
    <li class="active"><i class="fa fa-camera"></i>{{$sponsor?'Update':'Create'}} sponsor</li>
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
                      
                        <form id="form-upload" action="{{route('admin.sponsor.store',$sponsor?$sponsor:'')}}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Sponsor Name *</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter sponsor name" value="{{$sponsor?$sponsor->name:''}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Logo *</label>
                                        <input type="file" name="logo" class="form-control" id="logo">
                                    </div>
                                    @if($sponsor)
                                    <img src="{{$sponsor->logo}}" alt="{{$sponsor->name}}" class="img-responsive" style="width:50px">
                                    @endif
                                </div>

                          </div>
                          <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{$sponsor?'Update':'Create'}}</button>
                        </div>
                        </form>

                          
                    </div>
                </div>

            </div>
           
        </div>
</div>
    </div>
@endsection