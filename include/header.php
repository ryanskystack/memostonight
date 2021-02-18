<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="./assets/images/logo01.png" id="logo" alt="Brand Logo" style="height:5rem" /></a>
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarResponsive"><span class="navbar-toggler-icon"></span>
    </button>

    <!-- <div class="navbar-nav collapse navbar-collapse" id="navbarResponsive"> -->
   
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <div class="nav-link" id="google_translate_element"></div>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="index.php" active>Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">           
              <a class="nav-link" href="book.php">Search</a>
        </li>
        
        <?php
          if(!isset($_SESSION['userLogin'])){
            echo "<li class='nav-item active'>
                  <a class='nav-link' href='login.php'>Login<span class='sr-only'>(current)</span></a>
                    </li>";
          }
          if(isset($_SESSION['userLogin'])){
            echo "<li class='nav-item active'>
                  <a class='nav-link' onclick='return confirm(\"Are you sure you want to log out?\")' href='logout.php'>Logout<span class='sr-only'>(current)</span></a>
                    </li>";
          }
        ?>
      </ul>
    </div>
  </div>
</nav>