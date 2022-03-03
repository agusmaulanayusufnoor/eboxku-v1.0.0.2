<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt blue"></i>
          <p>
            Dashboard
          </p>
        </router-link>
      </li>

     @can('isAdmin')
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="nav-icon fa fa-users fa-beat green"></i>
            <p>Users</p>
          </router-link>
        </li>
      @endcan
      @if((auth()->user()->type=='admin') or (auth()->user()->type=='pelayanan'))
            <!--  menu pelayanan  -->
            @include('layouts.menu.menu-pelayanan')
      @endif

      @if((auth()->user()->type=='admin') or (auth()->user()->type=='kredit'))
            <!--  menu kredit  -->
            @include('layouts.menu.menu-kredit')
      @endif

      @if((auth()->user()->type=='admin') or (auth()->user()->type=='akunting'))
            <!--  menu umum dan akunting cabang  -->
            @include('layouts.menu.menu-umum-akunting')
      @endif

      
      @if((auth()->user()->type=='admin') or (auth()->user()->type=='umumpst'))
            <!--  menu umum dan akunting cabang  -->
            @include('layouts.menu.menu-umum-pusat')
      @endif

      
      @if((auth()->user()->type=='admin') or (auth()->user()->type=='sekdir'))
            <!--  menu umum dan akunting cabang  -->
            @include('layouts.menu.menu-sekdir')
      @endif

      
      @if((auth()->user()->type=='admin') or (auth()->user()->type=='skai'))
            <!--  menu umum dan akunting cabang  -->
            @include('layouts.menu.menu-skai')
      @endif

      @if((auth()->user()->type=='admin') or (auth()->user()->type=='sdm'))
            <!--  menu umum dan akunting cabang  -->
            @include('layouts.menu.menu-sdm')
      @endif
     


      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog green"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="/product/category" class="nav-link">
              <i class="nav-icon fas fa-list-ol green"></i>
              <p>
                Category
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/product/tag" class="nav-link">
              <i class="nav-icon fas fa-tags green"></i>
              <p>
                Tags
              </p>
            </router-link>
          </li>

            <li class="nav-item">
              <router-link to="/developer" class="nav-link">
                  <i class="nav-icon fas fa-cogs white"></i>
                  <p>
                      Developer
                  </p>
              </router-link>
            </li>
        </ul>
      </li>

      @endcan


    </ul>
  </nav>
