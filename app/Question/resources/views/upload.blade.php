@extends('layouts.admin')

@section('title','Upload Questions')

@section('content-header', 'Upload Questions')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>home</a></li>
    <li class="active"><i class="fa fa-camera"></i>Upload Questions</li>
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
                      
                        <form id="form-upload" action="{{route('admin.question.import')}}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Question File *</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                        <span style="color:red">Only excel file *</span>
                                </div>
                          </div>
                          <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                        </form>

                          
                    </div>
                </div>

            </div>
           
        </div>
</div>
    </div>
@endsection