@extends('layouts.admin')

@section('title', $set?'Update quiz':'Create quiz')

@section('content-header',  $set?'Update quiz':'Create quiz')

@section('breadcrumb')
    <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>home</a></li>
    <li class="active"><i class="fa fa-camera"></i>{{$set?'Update':'Create'}} quiz</li>
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
                      
                        <form id="form-upload" action="{{route('admin.questionset.store',$set?$set:'')}}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="box-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Set Name *</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter set name" value="{{$set?$set->name:''}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">Start time *</label>
                                        <input type="datetime-local" class="form-control" name="start" id="start" placeholder="Enter start time" value="{{$set?$set->start:''}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sitename">End time *</label>
                                        <input type="datetime-local" class="form-control" name="end" id="end" placeholder="Enter end time" value="{{$set?$set->end:''}}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sponsor">Sponsor</label>
                                        <select name="sponsor_id" id="sponsor_id" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($sponsors as $sponsor)
                                            <option value="{{$sponsor->id}}" {{ !$set ? ' ' : ($set->sponsor_id==$sponsor->id ? 'selected' : '') }}>{{$sponsor->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                

                          </div>
                          <!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">{{$set?'Update':'Create'}}</button>
                        </div>
                        </form>

                          
                    </div>
                </div>

            </div>
           
        </div>
</div>
    </div>
@endsection