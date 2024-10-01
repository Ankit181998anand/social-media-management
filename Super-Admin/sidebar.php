<!-- sidebar.php -->
<!-- Sidebar Section -->
<nav class="col-12 col-lg-3 col-xl-2 left-navbar">
    <div class="logo">
        SMS
    </div>
    <div class="dashboard-title">
        <i class="bi bi-speedometer2 icon-margin text-secondary"></i> Dashboard
    </div>
    <nav class="nav flex-column">

        <!-- Trade Dropdown -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="tradeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-file-earmark-text icon-margin text-secondary"></i> Trade <i class="bi bi-chevron-down float-end text-secondary"></i>
            </a>
            <ul class="dropdown-menu bg-dark border-0" aria-labelledby="tradeDropdown">
                <li><a class="dropdown-item text-white" href="#"><i class="bi bi-plus-square"></i> Create Post</a></li>
                <li><a class="dropdown-item text-white" href="#"><i class="bi bi-eye"></i> View Post</a></li>
                <li><a class="dropdown-item text-white" href="#"><i class="bi bi-plus-square"></i> Add Channels</a></li>
            </ul>
        </div>

        <!-- Marketing Dropdown -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="marketingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-file-earmark-text icon-margin text-secondary"></i> Marketing <i class="bi bi-chevron-down float-end text-secondary"></i>
            </a>
            <ul class="dropdown-menu bg-dark border-0" aria-labelledby="marketingDropdown">
                <li><a class="dropdown-item text-white" href="#"><i class="bi bi-plus-square"></i> Create Post</a></li>
                <li><a class="dropdown-item text-white" href="#"><i class="bi bi-eye"></i> View Post</a></li>
                <li><a class="dropdown-item text-white" href="#"><i class="bi bi-plus-square"></i> Add Channels</a></li>
            </ul>
        </div>

        <!-- Updates Dropdown -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="updatesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-file-earmark-text icon-margin text-secondary"></i> Updates <i class="bi bi-chevron-down float-end text-secondary"></i>
            </a>
            <ul class="dropdown-menu bg-dark border-0" aria-labelledby="updatesDropdown">
                <li><a class="dropdown-item text-white" href="#"><i class="bi bi-plus-square"></i> Create Post</a></li>
                <li><a class="dropdown-item text-white" href="#"><i class="bi bi-eye"></i> View Post</a></li>
                <li><a class="dropdown-item text-white" href="#"><i class="bi bi-plus-square"></i> Add Channels</a></li>
            </ul>
        </div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle icon-margin text-secondary"></i> User <i class="bi bi-chevron-down float-end text-secondary"></i>
            </a>
            <ul class="dropdown-menu bg-dark border-0" aria-labelledby="userDropdown">
                <li><a class="dropdown-item text-white" href="./createUser.php"><i class="bi bi-person-plus"></i> Create User</a></li>
                <li><a class="dropdown-item text-white" href="./viewAdmins.php"><i class="bi bi-person-lines-fill"></i> View Users</a></li>
                <li><hr class="dropdown-divider"></li> <!-- Optional divider -->
                <li><a class="dropdown-item text-white" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Sign Out</a></li>
            </ul>
        </div>
    </nav>
</nav>
