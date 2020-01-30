<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if(Auth::guard('admin')->user()->picture){{Auth::guard('admin')->user()->picture}} @else {{asset('admin-css/dist/img/avatar.png')}} @endif" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{Auth::guard('admin')->user()->name}}</p>
                <a href="{{route('admin.profile')}}">{{Auth::guard('admin')->user()->email}}</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">

            <li id="dashboard">
              <a href="{{route('admin.dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>



            <li class="treeview" id="categories">
                <a href="#">
                    <i class="fa fa-heart"></i> <span>Sponsors</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="view-videos"><a href="{{route('admin.sponsors')}}"><i class="fa fa-eye"></i>View Sponsor</a></li>
                    <li id="add-video"><a href="{{route('admin.sponsor.create')}}"><i class="fa fa-plus"></i>Add Sponsor</a></li>
                </ul>
            </li>

            <li class="treeview" id="categories">
                <a href="#">
                    <i class="fa fa-object-group"></i> <span>Quiz Group</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="view-videos"><a href="{{route('admin.questionsets')}}"><i class="fa fa-eye"></i>View Groups</a></li>
                    <li id="add-video"><a href="{{route('admin.questionset.create')}}"><i class="fa fa-plus"></i>Add Groups</a></li>
                </ul>
            </li>

            <li class="treeview" id="categories">
                <a href="#">
                    <i class="fa fa-question"></i> <span>Questions</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="view-videos"><a href="{{route('admin.questions')}}"><i class="fa fa-eye"></i>View Questiosn</a></li>
                    <li id="add-video"><a href="{{route('admin.question.create')}}"><i class="fa fa-plus"></i>Add Question</a></li>
                    <li id="add-video"><a href="{{route('admin.question.upload')}}"><i class="fa fa-upload"></i>Upload Questions</a></li>
                </ul>
            </li>

            <li class="treeview" id="categories">
                <a href="#">
                    <i class="fa fa-bullhorn"></i> <span>Ads</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="view-videos"><a href="{{route('admin.ads')}}"><i class="fa fa-eye"></i>View Ads</a></li>
                    <li id="add-video"><a href="{{route('admin.ad.create')}}"><i class="fa fa-plus"></i>Add Ad</a></li>
                </ul>
            </li>


            <!-- place at bottom -->
            <li id="dashboard">
              <a href="{{route('admin.setting')}}">
                <i class="fa fa-cogs"></i> <span>Settings</span>
              </a>
            </li>
        </ul>

    </section>

    <!-- /.sidebar -->

</aside>