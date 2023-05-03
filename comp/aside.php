<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="../dist/img/restaurant.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">RESTAURANT</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
          <?php
                 if(isset($_SESSION['user_image']))
                 echo '<img class="img-circle elevation-2" src="data:image/jpeg;base64,'.base64_encode($_SESSION["user_image"]).'" >';            
          ?>
         
        </div>
        <div class="info">
          <a href="../users/login.php" class="d-block"><?php if(!isset($_SESSION["user_login"])) echo "login";?></a>
          <?php 
                  if(isset($_SESSION['user_login']))
                  {
                    $checkuser = checkuser($_SESSION['user_login'],'admin');
                    if($checkuser=="yes")
                    {
                      ?>
          <a href="../users/user_profile.php?user_no=<?php echo $_SESSION["user_no"];?>"class="d-block"><?php if(isset($_SESSION["user_login"])) echo $_SESSION["user_name"]; ?></a>
          <?php
                      
                    }
                  }
                  ?>
          <a href="../users/logout.php" class="d-block"><?php if(isset($_SESSION["user_login"])) echo "logout";?></a>
        </div>
      </div>

  

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

              


               <?php 
                  if(isset($_SESSION['user_login']))
                  {
                    $checkuser = checkuser($_SESSION['user_login'],'admin');
                    if($checkuser=="yes")
                    {
                      ?>
                      <li class="nav-header">USERS</li>
                            <li class="nav-item">
                                <a href="../users/users_list.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Manage User</p>
                                </a>
                              </li>
                            <li class="nav-item">
                                <a href="../authorize/authorize_list.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Define Authorization</p>
                                </a>
                              </li>
                            </li>
                      <li class="nav-header">MENU&TABLE</li>
                              <li class="nav-item">
                                <a href="../menu/menu_list.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Menu</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="../table/table_list.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Table</p>
                                </a>
                              </li>
                              </li>
                      <?php
                      
                    }
                  }
                  ?>
                  <?php 
                  if(isset($_SESSION['user_login']))
                  {
                    $checkuser = checkuser($_SESSION['user_login'],'sale');
                    if($checkuser=="yes")
                    {
                      ?>
                      <li class="nav-header">INCOME REPORT</li>
                              <li class="nav-item">
                                <a href="../report/income_report_month.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Monthly Report</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="../report/income_report_daily.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Daily Report</p>
                                </a>
                              </li>
                              <!-- <li class="nav-header">SALE REPORT</li>
                              <li class="nav-item">
                                <a href="../report/sale_report_month.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Monthly Report</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="../report/sale_report_daily.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Daily Report</p>
                                </a>
                              </li> -->
                              <li class="nav-header">ORDER</li>                             
                              <li class="nav-item">
                                <a href="../order/order_list.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                <p>Take Order</p>
                                </a>
                              </li>
                            </li>
                      <?php
                      
                    }
                  }
                  ?>
                                    <?php 
                  if(isset($_SESSION['user_login']))
                  {
                    $checkuser = checkuser($_SESSION['user_login'],'kitchen');
                    if($checkuser=="yes")
                    {
                      ?>
                          
                              <li class="nav-item">
                                <a href="../order/order_more_list.php" class="nav-link">
                                <i class="fas fa-circle nav-icon"></i>
                                <p>Order in</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="../order/order_served_list.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Order served </p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="../order/order_succeed_list.php" class="nav-link">
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Order Succeed</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="../order/order_cancel_list.php" class="nav-link" style="color:red";>
                                  <i class="fas fa-circle nav-icon"></i>
                                  <p>Order Cancel</p>
                                </a>
                              </li>
                            </li>
                            <br><br><br><br>
                      <?php
                      
                    }
                  }
                  ?>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>