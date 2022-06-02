<?php require_once "includes/sessions.php"; ?>

<?php require_once "includes/header.php"; ?>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php require_once "includes/menu.php"; ?>
        
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php require_once "includes/nav.php"; ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Action /</span> Add Event</h4>

              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link" href="add-event.php"><i class="bx bx-plus me-1"></i> Add Event</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="pages-account-settings-notifications.html"
                        ><i class="bx bx-bell me-1"></i>My Events</a
                      >
                    </li>
                  </ul>
                  <?php 
										if (isset($_SESSION['message'])): ?>

											<div class="alert alert-<?=$_SEESION['msg_type']?>">

												<?php
													echo $_SESSION['message'];
													unset($_SESSION['message']);
												?>
											</div>	
									<?php endif ?>
                  <?php 
										$mysqli = new mysqli('localhost', 'root', '', 'trybae_site') or die(mysqli_error($mysqli));
										$result = $mysqli->query("SELECT * FROM events") or die($mysqli->error);
									?>
                  <!-- Basic Bootstrap Table -->
                  <div class="card">
                    <h5 class="card-header">Table Basic</h5>
                    <div class="table-responsive text-nowrap">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Event Id</th>
                            <th>Event Name</th>
                            <th>Address</th>
                            <th>Total Tickets</th>
                            <th>Date</th>
                            <th>V.I.P Price</th>
                            <th>Ordinary Price</th>
                            <th></th>
                          </tr>
                        </thead>
                        <?php 
												while ($row = $result->fetch_assoc()): ?>
                        <tbody class="table-border-bottom-0">
                          <tr>
                            <td><?php echo $row['event_id']; ?></td>
                            <td><?php echo $row['event_name']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['limits']; ?></td>
                            <td><?php echo $row['dates']; ?></td>
                            <td><?php echo $row['vip']; ?></td>
                            <td><?php echo $row['ordinary']; ?></td>
                            <td>
                              <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                  <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" href="controllerUserData.php?edit=<?php echo $row['id']; ?>"
                                    ><i class="bx bx-edit-alt me-2"></i> Edit</a
                                  >
                                  <a class="dropdown-item" href="controllerUserData.php?delete=<?php echo $row['id']; ?>"
                                    ><i class="bx bx-trash me-2"></i> Delete</a
                                  >
                                </div>
                              </div>
                            </td>
                            <?php endwhile; ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->

            <!-- Footer -->
            <?php require_once "includes/footer.php"; ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        $(function () {
            $.extend(true, $.fn.datetimepicker.defaults, {
                icons: {
                    time: 'far fa-clock',
                    date: 'far fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'far fa-calendar-check-o',
                    clear: 'far fa-trash',
                    close: 'far fa-times'
                }
            });
        });
        </script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker').datetimepicker({
                  ignoreReadonly: true
                });
            });

            $(function () {
                $('#datetimepicker1').datetimepicker({
                  format: 'YYYY-MM-DD',
                  ignoreReadonly: true
                });
            });

            $(function () {
                $('#datetimepicker2').datetimepicker({
                  format: 'hh:mm a',
                  ignoreReadonly: true
                });
            });

            $(function () {
                $('#datetimepicker3').datetimepicker({
                  format: 'HH:mm',
                  ignoreReadonly: true
                });
            });

            $(function () {
              var minDate = new Date();

              minDate.setDate(minDate.getDate()-5); // set days - mean previous date from current date + mean future date from current date

                $('#datetimepicker4').datetimepicker({
                  format: 'YYYY-MM-DD',
                  minDate: minDate,
                  ignoreReadonly: true
                });
            });

            $(function () {
              var minDate = new Date();
              var maxDate = new Date();

              minDate.setDate(minDate.getDate()-5); // set days - mean previous date from current date + mean future date from current date
              maxDate.setDate(maxDate.getDate()+10);
                $('#datetimepicker5').datetimepicker({
                  format: 'YYYY-MM-DD',
                  minDate: minDate,
                  maxDate: maxDate,
                  ignoreReadonly: true
                });
            });

        </script>
  </body>
</html>
