

<style>
 @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

   .title-tb {
    font-family: 'Fredoka One', cursive;
font-size: 30px; 



   }
</style>


<nav class="navbar navbar-expand navbar-light bg-gray topbar mb-4 static-top shadow" style="background color:">
<div class="pull-right">
<script src="https://cdn.lordicon.com/xdjxvujz.js"></script>
<lord-icon
    src="https://cdn.lordicon.com/ajyyzcwv.json"
    trigger="loop-on-hover"
    colors="primary:#121331,secondary:#0a5c49"
    style="width:75px;height:75px">
</lord-icon>
    </div>
<div class="ml-2 mt-3">
    


    <h5 class="title-tb">Taska Ummi Sakiza</h5>
</div>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto ">

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username'] ?></span>
            <img class="img-profile rounded-circle"
                src="../img/undraw_profile.svg">
            
        </a>
        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ManageModal">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
            </a>
         
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Sign Out
            </a>
        </div>
    </li>

</ul>

</nav>
<!-- End of Topbar -->
    
