<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="display: flex; justify-content: center; align-items: center;">
        <a href="index.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img src="../assets/img/logo/hotel.png" alt="Re' hotel logo" width="175">
            </span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>
    <div class="menu-inner-shadow"></div>

    <!--sidebar-->
    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item active">
            <a href="index.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Customers</span>
        </li>
        <!--Booking-->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Layouts">Booking</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="addbook.php" class="menu-link">
                        <div data-i18n="Without menu">Add Booking</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="listbook.php" class="menu-link">
                        <div data-i18n="Without navbar">List Booking</div>
                    </a>
                </li>
            </ul>
        </li>
        <!--Payment-->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
                <div data-i18n="Payment">Payment</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="histpayment.php" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">History Payment</div>
                    </a>
                </li>
            </ul>
        </li>
        <!--Feedback-->
        <li class="menu-item">
            <a href="feedback.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-chat"></i>
                <div data-i18n="Tables">Feedback</div>
            </a>
        </li>
        <!-- HOTELS -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">HOTELS</span></li>
        <!-- Rooms -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-hotel"></i>
                <div data-i18n="User interface">Rooms</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="addroom.php" class="menu-link">
                        <div data-i18n="Accordion">Add Rooms</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="listroom.php" class="menu-link">
                        <div data-i18n="Alerts">List Rooms</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Staff -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Extended UI">Staff</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="addstaff.php" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Add Staff</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="liststaff.php" class="menu-link">
                        <div data-i18n="Text Divider">List Staff</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Account -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">ACCOUNT</span></li>
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Extended UI">My Profile</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="account.php" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Edit Profile</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="password.php" class="menu-link">
                        <div data-i18n="Text Divider">Change Password</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="login.php" class="menu-link">
                <i class="menu-icon tf-icons bx bx-exit"></i>
                <div data-i18n="Documentation">Log Out</div>
            </a>
        </li>
    </ul>
</aside>
<!-- End sidebar -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('.menu-item').click(function(){
            $('.menu-item').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if (isset($_SESSION['result']) && $_SESSION['result'] != "") { ?>
    <!-- isset = check ada atau tak & name mesti tak kosong -->
    <script>
      Swal.fire({
        position: 'top-end',
        icon: '<?php echo $_SESSION['icon']; ?>',
        title: '<?php echo $_SESSION['result']; ?>',
        text: '<?php echo $_SESSION['message']; ?>',
        showConfirmButton: false,
        timer: 3000
      })
    </script>
    <?php unset($_SESSION['result']);
  } ?> <!--tak keluar result banyak kali-->
