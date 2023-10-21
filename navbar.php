<nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
            <a class="navbar-brand" href="#">JoomDev</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <?php if ($_SESSION['user']['role'] == 'admin') { ?>
                              <li class="nav-item">
                                    <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] == '/' ? 'active' : ''; ?> " aria-current="page" href="adminpage.php">Home</a>
                              </li>
                              <li class="nav-item">
                                    <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] == '/joomdev/addEmpForm.php' ? 'active' : ''; ?>" href="addEmpForm.php">Add Employee</a>
                              </li>
                              <li class="nav-item">
                                    <form action="export.php" method="post" class="d-inline">
                                          <button type="submit" class="btn btn-secondary" name="submit"><i class="fa fa-download" aria-hidden="true"></i>Export task list</button>
                                    </form>
                              </li>
                        <?php } else { ?>
                              <li class="nav-item">
                                    <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] == '/joomdev/tasklist.php' ? 'active' : ''; ?>" aria-current="page" href="tasklist.php">Home</a>
                              </li>
                              <li class="nav-item">

                                    <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] == '/joomdev/addtask.php' ? 'active' : ''; ?>" href="emppage.php">Add task</a>
                              </li>
                        <?php } ?>
                  </ul>
                  <span class="text-end">Welcome, <?php echo $_SESSION['user']['name'] ?  ucfirst($_SESSION['user']['name']) : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <form action="logout_process.php" method="post" class="d-inline">
                              <button type="submit" class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</button>
                        </form>
                  </span>
            </div>
      </div>
</nav>