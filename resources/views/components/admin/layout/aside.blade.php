 @props(['menu'=>'Dashboard'])
 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> <!--begin::Sidebar Brand-->
     <div class="sidebar-brand"> <!--begin::Brand Link--> <a href="{{ route('dashboard') }}" class="brand-link">
             <!--begin::Brand Image--> <img src="{{ asset('/') }}/dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                 class="brand-image opacity-75 shadow"> <!--end::Brand Image--> <!--begin::Brand Text--> <span
                 class="brand-text fw-light">AdminLTE 4</span> <!--end::Brand Text--> </a> <!--end::Brand Link--> </div>
     <!--end::Sidebar Brand--> <!--begin::Sidebar Wrapper-->
     <div class="sidebar-wrapper">
         <nav class="mt-2"> <!--begin::Sidebar Menu-->
             <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                 <li class="nav-item"> <a href="{{ route('dashboard') }}" class="nav-link "> <i
                             class="nav-icon bi bi-circle"></i>
                         <p>Dashboard</p>
                     </a> </li>

                 @role('admin')
                     <li class="nav-item menu-open"> <a href="#" class="nav-link active"> <i
                                 class="nav-icon bi bi-gear"></i>
                             <p>
                                 Setting
                                 <i class="nav-arrow bi bi-chevron-right"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             <li class="nav-item"> <a href="{{ route('role.index') }}" class="nav-link "> <i
                                         class="nav-icon bi bi-circle"></i>
                                     <p>Role </p>
                                 </a> </li>
                             <li class="nav-item"> <a href="{{ route('permission.index') }}" class="nav-link "> <i
                                         class="nav-icon bi bi-circle"></i>
                                     <p>Permission </p>
                                 </a> </li>
                             <li class="nav-item"> <a href="{{ route('user.index') }}" class="nav-link "> <i
                                         class="nav-icon bi bi-circle"></i>
                                     <p>User </p>
                                 </a> </li>

                         </ul>
                     </li>
                 @endrole
                @role(['admin'])
                    <li class="nav-item menu-open"> <a href="#" class="nav-link active"> <i
                                class="nav-icon bi bi-book"></i>
                            <p>
                                Master
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                             <li class="nav-item"> <a href="{{ route('item.index') }}"  class="nav-link {{ ($menu=='Items')?'active':'' }} "> <i
                                        class="nav-icon bi bi-circle"></i>
                                    <p>Item </p>
                                </a> </li>
                                 <li class="nav-item"> <a href="{{ route('customer.index') }}"  class="nav-link {{ ($menu=='Items')?'active':'' }} "> <i
                                        class="nav-icon bi bi-circle"></i>
                                    <p>Customer </p>
                                </a> </li>


                        </ul>
                    </li>
                @endrole


             </ul> <!--end::Sidebar Menu-->
         </nav>
     </div> <!--end::Sidebar Wrapper-->
 </aside> <!--end::Sidebar--> <!--begin::App Main-->
