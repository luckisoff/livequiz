@extends('layouts.admin')

@section('title', 'Ads')

@section('content-header', 'Ads')

@section('breadcrumb')
	<li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
	<li class="active"><i class="fa fa-suitcase"></i> Ads</li>
@endsection

@section('content')

@include('notification.notify')
	<div class="row">
    <div class="col-xs-12">
      <div class="box box-primary">
        <div class="box-header">
            <div class="box-tools pull-right">
            		<a href="{{route('admin.ad.create')}}" class="btn btn-default pull-right">Add Ad</a>
            </div>
            <br>
        </div>
        <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>SN.</th>
                            <th>Ad Name</th>
                            <th>Ad Banner</th>
                            <th>Ad Video</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ads as $key => $ad)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$ad->name}}</td>
                            <td>
                                <img src="{{$ad->banner}}" alt="{{$ad->name}}" class="img-responsive" style="width:50px">
                            </td>
                            <td>
                                @if($ad->video)
                                    <a href="{{$ad->video}}" target="_blank">Video Link</a>
                                @else
                                    No video Link
                                @endif
                            </td>
                            <td>
                                <ul class="admin-action btn btn-default pull-right">
                                    <li class="dropup">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        action <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" href="{{route('admin.ad.create' , $ad->id)}}">Edit</a>
                                        </li>
                                        <li role="presentation">
                                            <a role="menuitem" tabindex="-1" onclick="return confirm('Are you sure?')" href="{{route('admin.ad.delete' ,$ad->id)}}">Delete</a>
                                        </li>

                                    </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $ads->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection