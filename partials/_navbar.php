<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">NOTTY</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php
        if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
          echo ' <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="login.php">Login</a>
      </li>';

          echo '<li class="nav-item">
      <a class="nav-link active" aria-current="page" href="signup.php">Create Account</a>
    </li>';
        }
        ?>




        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
          echo '<li class="nav-item">
            <a class="nav-link active" aria-current="page" href="logout.php">Logout</a>
          </li>';
        }
        ?>



      </ul>
    </div>
  </div>
</nav>