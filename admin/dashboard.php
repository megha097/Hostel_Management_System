<?php
session_start();
include('../db.php');

// 🔒 Prevent browser from showing cached pages after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">

<style>

    .sidebar h2 
    {
        color: #00eaff;
        text-align: center;
        margin-bottom: 20px;
    }

    .close-sidebar-btn 
    {
        display: none; /* hidden on large screens */
        position: absolute;
        margin-top: 7px;
        right: 20px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255,255,255,0.1);
        border: none;
        color: #00eaff;
        font-size: 20px;
        text-align: center;
        line-height: 32px;
        cursor: pointer;
        transition: 0.3s;
    }

    .close-sidebar-btn:hover 
    {
        background: rgba(0,234,255,0.2);
        color: #fff;
        box-shadow: 0 0 10px rgba(0,234,255,0.6);
    }

    /* Show only on mobile/tablet */
    @media (max-width: 900px) 
    {
        .sidebar h2 
        {
            color: #00eaff;
            text-align: center;
            padding-right: 40px;
            margin-top: 6px;
        }
        .close-sidebar-btn 
        {
            display: block;
        }
    }

    /* Hide other topbar on large screens */
    .other-topbar 
    {
      display: none;
    }

    /* Show only on small screens */
    @media (max-width: 900px) 
    {
      .other-topbar 
      {
         display: flex;
         align-items: center;
         justify-content: flex-start;
         padding: 10px 15px;
         background: rgba(255, 255, 255, 0.05);
         backdrop-filter: blur(10px);
         border-radius: 12px;
         color: #fff;
      }

      .other-topbar .menu-toggle 
      {
         font-size: 22px;
         cursor: pointer;
         transition: 0.3s;
      }

    }

</style>
    </head>

<body>

<div class="sidebar" id="sidebar">
    
    <h2>Admin Panel</h2>
    <span class="close-sidebar-btn" onclick="closeSidebar()">×</span>

    <?php $current_page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>

    <a href="dashboard.php?page=home" class="<?= $current_page == 'home' ? 'active' : '' ?>">
        <i class="fa-solid fa-gauge-high"></i> Dashboard
    </a>

    <a href="dashboard.php?page=add_student" class="<?= $current_page == 'add_student' ? 'active' : '' ?>">
        <i class="fa-solid fa-user-plus"></i> Add Student
    </a>

    <a href="dashboard.php?page=rooms" class="<?= $current_page == 'rooms' ? 'active' : '' ?>">
        <i class="fa-solid fa-bed"></i> Manage Rooms
    </a>

    <a href="dashboard.php?page=view_complaint" class="<?= $current_page == 'view_complaint' ? 'active' : '' ?>">
        <i class="fa-solid fa-envelope-open-text"></i> View Complaints
    </a>

    <div class="submenu">
        
        <a href="dashboard.php?page=view_fees" class="<?= $current_page == 'view_fees' ? 'active' : '' ?>">
            <i class="fa-solid fa-wallet"></i> Fee Management
        </a>

        <div class="submenu-items">
              <a href="dashboard.php?page=add_fee" class="<?= $current_page == 'add_fee' ? 'active' : '' ?>">
                <i class="fa-solid fa-plus"></i>Add New Fee</a>
        </div>
    
    </div>
    
    <a href="dashboard.php?page=manage_announcements" class="<?= $current_page == 'manage_announcements' ? 'active' : '' ?>">
        <i class="fa-solid fa-bullhorn"></i> Manage Announcements
    </a>

    <a href="dashboard.php?page=change_password" class="<?= $current_page == 'change_password' ? 'active' : '' ?>">
        <i class="fa-solid fa-key"></i> Change Password
    </a>

</div>

    <div class="main-content">
        <?php 
    $current_page = isset($_GET['page']) ? $_GET['page'] : 'home';
    
    if ($current_page === 'home') 
    { 
    ?>
        <div class="topbar">
            <span class="menu-toggle" onclick="toggleSidebar()">☰</span>
            <h2><i class="fa-solid fa-user-shield"></i> Welcome, Admin!</h2>
            <form method="post" action="logout.php">
                <button class="logout" type="submit">Logout</button>
            </form>
        </div>
    <?php } ?>

       
    <div class="container">
    <?php
    // Check which page to load
    if (!isset($_GET['page']) || $_GET['page'] == '' || $_GET['page'] == 'dashboard') 
    {
        // If no page parameter OR page is empty OR page = dashboard → load home.php
        include("home.php");
    } 
    else 
    {
        // Sanitize the page parameter to prevent directory traversal
        $page = basename($_GET['page']); 
        $file = $page . ".php";

        if (file_exists($file)) 
        {
            // If file exists
            if ($file != "home.php") 
            {
                // Only show topbar if NOT home.php
                ?>
                <div class="topbar other-topbar">
                    <span class="menu-toggle" onclick="toggleSidebar()">☰</span>
                </div>
                <?php
            }
            // Include the requested page
            include($file);
        } 
        else 
        {
            // If file doesn't exist → fallback to home.php
            include("home.php");
        }
    }
    ?>
</div>

<script>

    function toggleSidebar() 
    {
      document.getElementById("sidebar").classList.toggle("active");
    }

    function closeSidebar() 
    {
      document.getElementById("sidebar").classList.remove("active");
    }
    
</script>
</body>
</html>