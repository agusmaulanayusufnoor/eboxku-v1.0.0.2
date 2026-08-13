<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt blue"></i>
          <p><b>
            Dashboard</b>
          </p>
        </router-link>
      </li>

     @can('isAdmin')
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="nav-icon fa fa-users fa-beat green"></i>
            <p><b>Users</b></p>
          </router-link>
        </li>
      @endcan
      @if(auth()->user()->hasRole(['admin', 'pelayanan', 'cs', 'teller']))
            <!--  menu pelayanan  -->
            @include('layouts.menu.menu-pelayanan')
      @endif

      @if(auth()->user()->hasRole(['admin', 'kredit', 'bisnis', 'pelayanan', 'cs']))
            <!--  menu kredit  -->
            @include('layouts.menu.menu-kredit')
      @endif

      @if(auth()->user()->hasRole(['admin', 'akunting', 'cs']))
            <!--  menu umum dan akunting cabang  -->
            @include('layouts.menu.menu-umum-akunting')
      @endif

      @if(auth()->user()->hasRole(['admin', 'umumpst']))
            <!--  menu umum pusat  -->
            @include('layouts.menu.menu-umum-pusat')
      @endif

      @if(auth()->user()->hasRole(['admin', 'umumpst']))
            <!--  menu akunting pusat -->
            @include('layouts.menu.menu-akunting-pusat')
      @endif

      @if(auth()->user()->hasRole(['admin', 'sekdir']))
            <!--  menu sekdir  -->
            @include('layouts.menu.menu-sekdir')
      @endif

      @if(auth()->user()->hasRole(['skai']))
            <!--  menu skai  -->
            @include('layouts.menu.menu-skai')
      @endif

      @if(auth()->user()->hasRole(['admin', 'sdm']))
            <!--  menu sdm  -->
            @include('layouts.menu.menu-sdm')
      @endif

      @if(auth()->user()->hasRole(['admin', 'ppk']))
            <!--  menu ppk  -->
            @include('layouts.menu.menu-ppk')
      @endif



      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog green"></i>
          <p>
            <b>Settings</b>

          </p>
          <i class="right fas fa-angle-left"></i>
        </a>
        <ul class="nav nav-treeview">

            <li class="nav-item">
              <router-link to="/developer" class="nav-link">
                  <i class="nav-icon fas fa-cogs white"></i>
                  <p>
                      Developer
                  </p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/kantor" class="nav-link">
                  <i class="nav-icon fas fa-building white"></i>
                  <p>
                      Kantor
                  </p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/pincab" class="nav-link">
                  <i class="nav-icon fas fa-user-tie white"></i>
                  <p>
                      Pincab
                  </p>
              </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/mastersimpanan" class="nav-link">
                    <i class="nav-icon fas fa-wallet white"></i>
                    <p>
                        Simpanan
                    </p>
                </router-link>
              </li>
            <li class="nav-item">
              <router-link to="/satuan" class="nav-link">
                  <i class="nav-icon fas fa-scale-balanced white"></i>
                  <p>
                      Satuan
                  </p>
              </router-link>
            </li>
            <li class="nav-item">
                <router-link to="/barang" class="nav-link">
                    <i class="nav-icon fas fa-cart-plus white"></i>
                    <p>
                        Barang
                    </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/otorisator" class="nav-link">
                    <i class="nav-icon fas fa-user-secret white"></i>
                    <p>
                        Otorisator
                    </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/jabatan" class="nav-link">
                    <i class="nav-icon fas fa-user-graduate white"></i>
                    <p>
                        Jabatan
                    </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/pendidikan" class="nav-link">
                    <i class="nav-icon fas fa-graduation-cap white"></i>
                    <p>
                        Pendidikan
                    </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/statuspegawai" class="nav-link">
                    <i class="nav-icon fas fa-user-tag white"></i>
                    <p>
                        Status Pegawai
                    </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/statuspajak" class="nav-link">
                    <i class="nav-icon fas fa-universal-access white"></i>
                    <p>
                        Status Pajak
                    </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/statuspermohonan" class="nav-link">
                    <i class="nav-icon fa fa-square-check white"></i>
                    <p>
                        Status Permohonan Kredit
                    </p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/role" class="nav-link">
                    <i class="nav-icon fas fa-user-shield white"></i>
                    <p>
                        Role User
                    </p>
                </router-link>
              </li>
        </ul>
      </li>

      @endcan


    </ul>
  </nav>
