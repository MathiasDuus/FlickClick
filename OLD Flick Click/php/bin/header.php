<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}?>
<!-- top nav bar -->

<nav class="navbar navbar-expand navbar-dark bg-darkgray">
    
  <div class="collapse navbar-collapse">
      <a id="flickClickLogo" href="index.php"><img src="../images/logo.png" alt="Flick Click Logo"/></a>
    <div class="navbar-nav ml-auto">
        <a id="frontpage" class="col-sm nav-item nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
        <a id="news" class="col-sm nav-item nav-link" href="news.php">NEWS</a>
        <a id="contact" class="col-sm nav-item nav-link" href="contact.php">CONTACT</a>
    </div>
  </div>
</nav>


<!-- Nav-bar search -->

<nav id="nav-middle" class="navbar navbar-expand navbar-dark bg-darkgray nav-height">

  <div class="collapse navbar-collapse">
    <div class="navbar-nav mr-auto">
        <a class="nav-item nav-link" href="filter.php?filter=show_all">SHOW ALL</a>
        <a class="nav-item nav-link" href="filter.php?filter=latest_trailer">LATEST TRAILERS</a>
        <a class="nav-item nav-link" href="filter.php?filter=most_commented">MOST COMMENTED</a>
    </div>
      
      <form class="form-inline my-2 my-lg-0" method="POST" action="search.php">
      <p id="searchText">SEARCH</p>
      <input class="form-control mr-sm-2 search" type="search" name="search_movie" placeholder="Enter search here" aria-label="Search">
      <button class="btn my-2 my-sm-0 search-btn" name="search" type="submit">GO!</button>
    </form>
  </div>
</nav>


<?php
include_once '../bin/alert.php';
//Change the lowest navbar if logged in
if (isset($_SESSION['user_mail'])) {
?>

<nav class="navbar navbar-expand navbar-dark bg-darkgray nav-height">
    
  <div class="collapse navbar-collapse">
    <div class="navbar-nav ml-auto">
      <form class="form-inline my-2 my-lg-0" method="POST" action="user_profile.php">
          <button class="btn my-2 my-sm-0 NotAMember-btn" name="my_profile" value="<?php echo $_SESSION['user_mail'];?>" type="submit">My profile</button>
      </form>
        
      <form class="form-inline my-2 my-lg-0" method="POST" action="BLL/logout.php">
          <button class="btn my-2 my-sm-0 NotAMember-btn" name="logout" type="submit">Log out</button>
      </form>
  </div>
  </div>
</nav>

<?php
} else {?>
<!-- lowest nav bar -->
<nav class="navbar navbar-expand navbar-dark bg-darkgray nav-height">
    
  <div class="collapse navbar-collapse">
    <div class="navbar-nav ml-auto">
      <form class="form-inline my-2 my-lg-0" method="POST" action="">
          <label for="email"></label>
          <input class="form-control mr-sm-2 search" id="email" name="email" type="email" placeholder="email">
          <label for="password"></label>
          <input class="form-control mr-sm-2 search" id="password" name="password" type="password" placeholder="password">
          <button class="btn my-2 my-sm-0 search-btn" name="sign_in" type="submit">Sign In</button>
      </form>
      
      <form class="form-inline my-2 my-lg-0" method="POST" action="new_member.php">
        <button class="btn my-2 my-sm-0 NotAMember-btn" type="submit">Not a member?</button>
      </form>
  </div>
  </div>
</nav>

<?php
}


    
    