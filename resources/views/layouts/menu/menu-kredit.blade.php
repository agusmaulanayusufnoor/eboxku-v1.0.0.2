<li class="nav-item">
    <a href="#" class="nav-link">
    <i class="nav-icon fas fa-file fa-flip red"  style="--fa-animation-duration: 3s;"></i>
      <p>
        <b>Kredit</b>


      </p>
      <i class="fas fa-angle-left right"></i>
    </a>
    <ul class="nav nav-treeview">
    @if((auth()->user()->type=='admin') || (auth()->user()->type=='bisnis'))
     <li class="nav-item">
        <router-link to="/permbisnis" class="nav-link">
         <i class="fas fa-money-check-alt nav-icon"></i>
             <p>Memo ke Operasional</p>
            </a>
     </li>
     @endif
      <li class="nav-item">
      <router-link to="/permohonankredit" class="nav-link">
        <i class="nav-icon fa fa-list-check"></i>
          <p>Permohonan Kredit</p>
        </a>
      </li>
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

        <li class="nav-item">
            <router-link to="/asuransikredit" class="nav-link">
                <i class="fas fa-hand-holding-usd nav-icon"></i>
                <p>File Asuransi Kredit</p>
              </a>
        </li>
    </ul>

</li>
