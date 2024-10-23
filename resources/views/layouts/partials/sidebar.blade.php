<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">


    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate">
            <img src="{{ asset('assets/img/newPmx-removebg-preview.png') }}">
        </div>
        <br>
        <div class="sidebar-brand-text mx-3">ProgresMax</div>
    </a>
    
    <hr class="sidebar-divider my-0">
    @canany(['create-role', 'edit-role', 'delete-role','create-user', 'edit-user', 'delete-user','create-lokasi', 'edit-lokasi', 'delete-lokasi','create-unit', 'edit-unit', 'delete-unit','create-sparepart', 'edit-sparepart', 'delete-sparepart' ])
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Master</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['create-role', 'edit-role', 'delete-role'])
                <a class="collapse-item" href="{{ route('roles.index') }}">Kategori User</a>
                @endcanany
                @canany(['create-user', 'edit-user', 'delete-user'])
                <a class="collapse-item" href="{{ route('users.index') }}">User</a>
                @endcanany
                @canany(['create-lokasi', 'edit-lokasi', 'delete-lokasi'])
                <a class="collapse-item" href="{{ route('locations.index') }}">Lokasi</a>
                @endcanany
                @canany(['create-unit', 'edit-unit', 'delete-unit'])
                <a class="collapse-item" href="{{ route('units.index') }}">Unit</a>
                @endcanany
                @canany(['create-sparepart', 'edit-sparepart', 'delete-sparepart'])
                <a class="collapse-item" href="{{ route('spareparts.index') }}">Sparepart</a>
                @endcanany
            </div>
        </div>
    </li>
    @endcanany

    
    @canany(['warehouse-sparepart-in','warehouse-sparepart-out','warehouse-sparepart-stock'])
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
            <i class="fas fa-fw fa-home"></i>
            <span>Warehouse</span>
        </a>
        <div id="collapse3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['warehouse-sparepart-in'])
                <a class="collapse-item" href="{{ route('warehouseSparepartIn') }}">Sparepart Masuk</a>
                @endcanany
                @canany(['warehouse-sparepart-out'])
                <a class="collapse-item" href="{{ route('warehouseSparepartOut') }}">Sparepart Keluar</a>
                @endcanany
                @canany(['warehouse-sparepart-stock'])
                <a class="collapse-item" href="{{ route('warehouseSparepartStock') }}">Stock Sparepart</a>
                @endcanany
            </div>
        </div>
    </li>
    @endcanany
   
    @canany(['location-sparepart-in','location-sparepart-buy','location-sparepart-out','location-sparepart-stock'])
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
            <i class="fas fa-fw fa-map-marker"></i>
            <span>Lokasi Project</span>
        </a>
        <div id="collapse4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['location-sparepart-in'])
                <a class="collapse-item" href="{{ route('locationSparepartIn') }}">Terima Sparepart</a>
                @endcanany
                @canany(['location-sparepart-buy'])
                <a class="collapse-item" href="{{ route('locationSparepartBuy') }}">Beli Sparepart</a>
                @endcanany
                @canany(['location-sparepart-out'])
                <a class="collapse-item" href="{{ route('locationSparepartOut') }}">Sparepart Keluar</a>
                @endcanany
                @canany(['location-sparepart-stock'])
                <a class="collapse-item" href="{{ route('locationSparepartStock') }}">Stock Sparepart</a>
                @endcanany
            </div>
        </div>
    </li>
    @endcanany

    
    @canany(['report-all-sparepart','report-sparepart-unit'])
    <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
            <i class="fas fa-fw fa-edit"></i>
            <span>Laporan</span>
        </a>
        <div id="collapse5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['location-sparepart-in'])
                <a class="collapse-item" href="{{ route('reportAllSparepart') }}">All Stock Sparepart</a>
                @endcanany
                @canany(['report-sparepart-unit'])
                <a class="collapse-item" href="{{ route('reportSparepartUnit') }}">Sparepart Unit</a>
                @endcanany
            </div>
        </div>
    </li>
    @endcanany
    
    <hr class="sidebar-divider">
    
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>