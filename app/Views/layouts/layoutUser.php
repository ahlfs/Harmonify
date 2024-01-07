<!DOCTYPE html>
<html>

<head>
  <title>CodeIgniter 4 Form Example</title>
  <link rel="stylesheet" href="/assets/css/styles.css" />
  <link rel="stylesheet" href="/assets/css/stylesProfile.css" />
  <link rel="stylesheet" href="/assets/css/modal.css" />
  <!-- <link rel="stylesheet" href="/vendor/bootstrap/css/bootstrap.min.css" /> -->


  <meta charset="UTF-8">
  <meta name="description" content="Free Web tutorials">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="author" content="Ahlfss">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<header>
  <nav class="navbar">
    <div class="menu">
      <!-- <img draggable="false" class="logo" src="https://cdn1.iconfinder.com/data/icons/logotypes/32/pinterest-512.png"> -->
      <a href="/" class="home">Beranda</a>
      <a class="create">Create</a>
      <input id="one" type="text" class="search-bar" placeholder="Search">
      <button id="two" class="search-bar"></button>
      <div class="icon-container">
        <a href="/profile"><img draggable="false" class="icon" src="https://i.pinimg.com/564x/bd/94/ce/bd94ce28cf8aefb521bac31d547f6409.jpg"></a>
      </div>
      <button class="create" id="open-modal">
        Login
      </button>
    </div>
    <!--------------------------->
    <div class="responsive-search-bar">
      <input type="text">
      <p class="close">❌</p>
    </div>
  </nav>
</header>
<section class="modal containerModal">
  <div class="modal__container" id="modal-container">
    <div class="modal__content">
      <div class="modal__close close-modal" title="Close">
        <i class='bx bx-x'></i>
      </div>

      <div class="login-div">
        <form class="login">
          <h1>Sign In</h1>
          <div class="input-text">
            <input type="text" id="inputEmail" name="email" placeholder="Email or phone number" />
            <div class="warning-input" id="warningEmail">
            </div>
          </div>

          <div class="input-text">
            <input type="password" id="inputPassword" name="password" placeholder="Password" />
            <div class="warning-input" id="warningPassword">
              Your password must contain between 4 and 60 characters.
            </div>
          </div>

          <div>
            <button class="signin-button">Sign In</button>
            <button class="close-modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<body>
  <?= $this->renderSection('content'); ?>
</body>
<script src="assets/js/script.js"></script>
<script src="/assets/js/modal.js"></script>

</html>