<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
    <h6 class="dropdown-header">User Information</h6>
    <div class="dropdown-item">
        <strong>Full Name:</strong> {{ Auth::user()->nama_lengkap }}
    </div>
    <div class="dropdown-item">
        <strong>Username:</strong> {{ Auth::user()->username }}
    </div>
    <div class="dropdown-item">
        <strong>Email:</strong> {{ Auth::user()->email}}
    </div>
    <div class="dropdown-item">
        <strong>Nomor Telepon:</strong> {{ Auth::user()->no_telp}}
    </div>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="{{ route('editProfileView') }}">
        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
        Edit Profile
    </a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutProfileModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </a>
</div>
</li>

<!-- Delete Profile Modal -->
<div class="modal fade" id="deleteProfileModal" tabindex="-1" role="dialog" aria-labelledby="deleteProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProfileModalLabel">Delete Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghapus Akun?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" href="{{ route('deleteProfile') }}"
                    onclick="event.preventDefault(); document.getElementById('delete-form').submit();">
                    Delete
                </a>
                <form id="delete-form" action="{{ route('deleteProfile') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>


<!--Logout Profile Modal -->
<div class="modal fade" id="logoutProfileModal" tabindex="-1" role="dialog" aria-labelledby="logoutProfileModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutProfileModalLabel">Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>


