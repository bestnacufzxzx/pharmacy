<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="<?=base_url()?>/public/images/logo2.png" width="70%" class="circle">
        </div>
        <div class="sidebar-brand-text mx-3">PHARMACY</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        ทั่วไป
      </div>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>ตั้งค่า</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">การจัดการผลัด</h6>
            <a class="collapse-item" href="<?=base_url("admin/edit_year"); ?>">ตั้งค่าปีการศึกษา</a>
            <a class="collapse-item" href="<?=base_url("admin/scheduler"); ?>">ตั้งค่าผลัด</a>
            <h6 class="collapse-header">จัดการประเภทการฝึก</h6>
            <a class="collapse-item" href="<?=base_url("admin/training_type?course_id=1"); ?>">ประเภทการฝึก SCI</a>
            <a class="collapse-item" href="<?=base_url("admin/training_type?course_id=2"); ?>">ประเภทการฝึก CARE</a>
            <h6 class="collapse-header">การจัดการแหล่งฝึก</h6>
            <a class="collapse-item" href="<?=base_url("admin/workplace"); ?>">ข้อมูลแหล่งฝึก</a>
            <a class="collapse-item" href="<?=base_url("admin/set_receive_detail"); ?>">ตั้งค่าการรับของแหล่งฝึก</a>
            <a class="collapse-item" href="<?=base_url("admin/manage_accommodation"); ?>">ที่พักใกล้แหล่งฝึก</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#import" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-file-import"></i>
          <span>นำเข้าข้อมูล</span>
        </a>
        <div id="import" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url("admin/import_lecturer/"); ?>">ข้อมูลอาจารย์</a>
            <a class="collapse-item" href="<?=base_url("admin/import_student/"); ?>">ข้อมูลนักศึกษา</a>
            <a class="collapse-item" href="<?=base_url("admin/trainer/"); ?>">ข้อมูลพนักงานที่ปรึกษา</a>
            <a class="collapse-item" href="<?=base_url("admin/import_enroll/"); ?>">ข้อมูลการลงทะเบียน</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#course" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-book"></i>
          <span>จัดการรายวิชา</span>
        </a>
        <div id="course" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">จัดการรายวิชา</h6>
            <a class="collapse-item" href="<?=base_url("admin/subject?course_id=1"); ?>">รายวิชา SCI</a>
            <a class="collapse-item" href="<?=base_url("admin/subject?course_id=2"); ?>">รายวิชา CARE</a>
            <h6 class="collapse-header">รายวิชาของปีการศึกษา</h6>
            <a class="collapse-item" href="<?=base_url("admin/subject_teach?course_id=1"); ?>">รายวิชา SCI</a>
            <a class="collapse-item" href="<?=base_url("admin/subject_teach?course_id=2"); ?>">รายวิชา CARE</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#duty" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-handshake"></i>
          <span>เลือกผลัด</span>
        </a>
        <div id="duty" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url("admin/set_student_workplace?course_id=1"); ?>">นักศึกษา SCI</a>
            <a class="collapse-item" href="<?=base_url("admin/set_student_workplace?course_id=2"); ?>">นักศึกษา CARE</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#set" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-hospital-alt"></i>
          <span>เลือกแหล่งฝึก</span>
        </a>
        <div id="set" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url("admin/set_workplace_to_student?course_id=1"); ?>">แหล่งฝึกนักศึกษา SCI</a>
            <a class="collapse-item" href="<?=base_url("admin/set_workplace_to_student?course_id=2"); ?>">แหล่งฝึกนักศึกษา CARE</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#check" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-user-edit"></i>
          <span>กำหนดผู้ตรวจรายงาน</span>
        </a>
        <div id="check" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url("admin/set_inspector?course_id=1"); ?>">รายงาน SCI</a>
            <a class="collapse-item" href="<?=base_url("admin/set_inspector?course_id=2"); ?>">รายงาน CARE</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="<?=base_url("admin/news"); ?>">
          <i class="fas fa-rss"></i>
          <span>ประกาศข่าว</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        ส่วนตัว
      </div>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url("admin/changepassword"); ?>">
          <i class="fas fa-user-lock"></i>
          <span>แก้ไขรหัสผ่าน</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->