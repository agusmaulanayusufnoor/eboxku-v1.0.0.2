<li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fa fa-briefcase fa-flip pink" style="--fa-animation-duration: 2s;"></i>
      <p>
     Sekdir
        <i class="fas fa-angle-left right"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-envelope nav-icon"></i>
              <p>Surat
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="small">
                    <router-link to="/suratmasuk" class="nav-link">
                        <i class="fa fa-envelope-open nav-icon"></i>
                        <p>Surat Masuk</p>
                      </a>
                </li>
                <li class="small">
                    <router-link to="/suratkeluar" class="nav-link">
                        <i class="fa fa-envelope-open-text nav-icon"></i>
                        <p>Surat Keluar</p>
                      </a>
                </li>

            </ul>
        </li>
          <li class="nav-item">
            <router-link to="/notulen" class="nav-link">
              <i class="fas fa-paste nav-icon"></i>
              <p>Notulen</p>
            </a>
          </li>
          <li class="nav-item">
            <router-link to="/polis" class="nav-link">
              <i class="fas fa-paste nav-icon"></i>
              <p>Polis Asuransi Jabatan </p>
            </a>
          </li>
    </ul>
  </li>
