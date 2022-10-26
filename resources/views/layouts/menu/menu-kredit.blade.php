<li class="nav-item">
    <a href="#" class="nav-link">
    <i class="nav-icon fas fa-file fa-flip red"  style="--fa-animation-duration: 3s;"></i>
      <p>
        <b>Kredit</b>


      </p>
      <i class="fas fa-angle-left right"></i>
    </a>
    <ul class="nav nav-treeview">

      <li class="nav-item">
      <router-link to="/kredit" class="nav-link">
        <i class="nav-icon fas fa-file-lines"></i>
          <p>File Kredit</p>
        </a>
      </li>
      @if((auth()->user()->kantor_id==1))
      <li class="nav-item">
        <router-link to="/pelunasan" class="nav-link">
          <i class="nav-icon fas fa-file-pdf"></i>
            <p>File Pelunasan Kredit</p>
          </a>
        </li>
        @endif
    </ul>
</li>
