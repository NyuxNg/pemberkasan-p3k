<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel py-5">
            <div class="pull-left image">
                <img src="{{ asset('public/template/adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="javascript:void(0)"><i class="fa fa-envelope text-success"></i> {{ Auth::user()->email }}</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ set_active('dashboard.index') }}">
                <a href="{{ route('dashboard.index') }}">
                    <i class="fa fa-dashboard text-info"></i> <span>Dashboard</span>
                </a>
            </li>
            @php
            $module = ['tabelrefrensi'];
            @endphp
            @for ($i = 0; $i < sizeof($module); $i++)
            @include($module[$i] . "::sidebar")
            @endfor
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>