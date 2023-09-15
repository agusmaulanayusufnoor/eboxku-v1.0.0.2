<li class="nav-item">
    <a href="#" class="nav-link">
      <i class="nav-icon fa fa-calculator fa-flip blue" style="--fa-animation-duration: 4s;"></i>
      <p>
        <b>Pelayanan</b>

      </p>
      <i class="fas fa-angle-left right"></i>
    </a>
    <ul class="nav nav-treeview">

{{-- menu BA Kas --}}
      <li class="nav-item">
        <router-link to="/bakas" class="nav-link">
          <i class="nav-icon fa-regular fa-file-lines"></i>
          <p>File Berita Acara Kas</p>
        </a>
      </li>
      <li class="nav-item">
        <router-link to="/feedback" class="nav-link">
          <i class="nav-icon fa-regular fa-comment-dots"></i>
          <p>File Feedback Nasabah</p>
        </a>
      </li>
      {{-- menu tabungan --}}
      <li class="nav-item">
        <router-link to="/tabungan" class="nav-link">
          <i class="nav-icon fas fa-money-bill"></i>
          <p>
            File Tabungan
          </p>
        </a>
      </li>

      {{-- menu deposito --}}
      <li class="nav-item">
        <router-link to="/deposito" class="nav-link">
            <i class="nav-icon fa fa-file-invoice-dollar"></i>
            <p>
              File Deposito
            </p>
          </a>
      </li>
        {{-- menu teller --}}
        <li class="nav-item">
            <router-link to="/teller" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>
                  File Teller
                </p>
              </a>
          </li>
        <li class="nav-item">
            <router-link to="/cs" class="nav-link">
            <i class="nav-icon fa-regular fa-file-archive"></i>
            <p>File CS</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-file-import"></i>
              <p>File Permohonan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="small">
                    <router-link to="/permoperasional" class="nav-link">
                        <i class="fas fa-cogs nav-icon"></i>
                        <p>Operasional</p>
                      </a>
                </li>
                <li class="small">
                    <router-link to="/permbisnis" class="nav-link">
                        <i class="fas fa-money-check-alt nav-icon"></i>
                        <p>Bisnis</p>
                      </a>
                </li>
            </ul>
        </li>

    </ul>
  </li>
