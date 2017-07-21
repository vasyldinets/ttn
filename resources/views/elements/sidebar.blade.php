<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/adminlte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    @if(Auth::check())
                        {{Auth::user()->profile->name}} {{Auth::user()->profile->lastname}}
                    @endif
                </p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <!-- Optionally, you can add icons to the links -->
            @if(Auth::user()->role == 'user')
                <li><a href="/home/ttn/find"><i class="fa fa-search"></i> <span>{{__('Find TTN')}}</span></a></li>
                <li><a href="/home/ttn/create"><i class="fa fa-plus"></i> <span>{{__('Create TTN')}}</span></a></li>
                <li><a href="/home/ttn"><i class="fa fa-list"></i> <span>{{__('My TTN')}}</span></a></li>
                <li><a href="/home/profile"><i class="fa fa-user"></i> <span>{{__('Profile')}}</span></a></li>
            @elseif(Auth::user()->role == 'operator')
                <li><a href="/operator/ttn/find"><i class="fa fa-search"></i> <span>{{__('Find TTN')}}</span></a></li>
                <li><a href="/operator/ttn/create"><i class="fa fa-plus"></i> <span>{{__('Create TTN')}}</span></a></li>
                <li><a href="/operator/user/update"><i class="fa fa fa-user"></i> <span>{{__('Update User')}}</span></a></li>
            @elseif(Auth::user()->role == 'logist')

            @endif
            {{--<li class="treeview">--}}
                {{--<a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="#">Link in level 2</a></li>--}}
                    {{--<li><a href="#">Link in level 2</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
