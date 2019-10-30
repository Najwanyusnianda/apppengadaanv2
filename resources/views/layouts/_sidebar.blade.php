<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{asset('vendor/adminlte/dist/img/adminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">App Pengadaan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="{{asset('vendor/adminlte/dist/img/avatar.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{auth()->user()->person->name}}</a>
                <small><a href="">{{auth()->user()->role->role ?? '(undefined)'}}</a></small>
       
            </div>
            
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

             <li class="nav-item"> 
                    <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                    </a>
            </li>
            <li class="nav-item">
                <a href="/logout" class="nav-link">
                    <i class="nav-icon fas fa-power-off"></i>
                    <p>
                        logout
                    </p>
                </a>
            </li>
             <li class="nav-header">Project Info</li>
                <li class="nav-item"> 
                <a href="{{route('project.info.index')}}" class="nav-link {{Request::is('project/info') ? 'active' : ''}}">
                                
                                <i class="nav-icon fas fa-users-cog"></i>
                                <p>
                                    Project and Member
                                </p>
                        </a>
                </li> 
                <li class="nav-item"> 
                <a href="{{route('bagian.index')}}" class="nav-link {{Request::is('bagian/list') ? 'active' : ''}}">
                                
                                <i class="nav-icon fas fa-address-book"></i>
                                <p>
                                    Subject Matter (Bagian)
                                </p>
                        </a>
                </li>

                <li class="nav-item">
                        <a href="{{route('permintaan.index')}}" class="nav-link {{Request::is('index/permintaan') ? 'active' : ''}}">
                            <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Daftar Permintaan
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                </li>




                <li class="nav-header">Works</li>



                <li class="nav-item">
                    <a href="{{route('works.index')}}" class="nav-link {{Request::is('works/disposisi') ? 'active' : ''}}">
                       
                        <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>
                                Disposisi
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                </li>
                <li class="nav-item">
                        <a href="{{route('box.inboxIndex')}}" class="nav-link  {{Request::is('inbox/disposisi') ? 'active' : Request::is('sent/disposisi') ? 'active' : '' }}">
                            
                               
                                <i class="nav-icon fas fa-mail-bulk"></i>
                                <p>
                                    Pesan
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                </li>


                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                </div>
                <li class="nav-header">Admin</li>
                <li class="nav-item"> 
                        <a href="{{route('project.index')}}" class="nav-link">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Project
                                </p>
                        </a>
                </li>
                        <li class="nav-item">
                            <a href="{{route('person.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-th"></i>
                                    <p>
                                        Person
                                        <span class="right badge badge-danger">New</span>
                                    </p>
                                </a>
                        </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>