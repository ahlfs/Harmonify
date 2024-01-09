<!DOCTYPE html>
<html>

<head>
  <title>CodeIgniter 4 Form Example</title>
  <link rel="stylesheet" href="/assets/css/styles.css" />
  <link rel="stylesheet" href="/assets/css/stylesProfile.css" />
  <link rel="stylesheet" href="/assets/css/modal.css" />
  <link rel="stylesheet" href="/assets/css/post.css" />
  <script src="https://kit.fontawesome.com/6d2fa4f343.js" crossorigin="anonymous"></script>



  <meta charset="UTF-8">
  <meta name="description" content="Free Web tutorials">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="author" content="Ahlfss">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<header>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="ion-ios-close"><i class="fa-solid fa-xmark fa-xl"></i></span>
        </button>
      </div>
      <div class="row no-gutters">
        <div class="col-md-6 d-flex">
          <div class="modal-body p-5 img d-flex text-center d-flex align-items-center" style="background-image: url(https://i.pinimg.com/564x/1c/56/d1/1c56d1e6e3f002f4109a1f59e56cf292.jpg);">
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <div class="modal-body p-4 p-md-5 d-flex align-items-center color-1">
            <div class="text w-100 py-3">
              <span class="subheading">Welcome to Harmonify</span>
              <h3 class="mb-4 heading">Login to continue</h3>
              <form action="#" class="contact-form">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Email">
                </div>
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                  <button type="submit" class="form-control btn btn-customblue rounded submit px-3"><span class="btn-custombluetext">Login</span></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

  <nav>
    <div class="menu">
      <!-- <img draggable="false" class="logo" src="https://cdn1.iconfinder.com/data/icons/logotypes/32/pinterest-512.png"> -->
      <a href="/" class="home">Beranda</a>
      <a href="/" class="create">Create</a>
      <input id="one" type="text" class="search-bar" placeholder="Search">
      <button id="two" class="search-bar"></button>
      <div class="icon-container">
        <a href="/profile"><img draggable="false" class="icon" src="https://i.pinimg.com/564x/bd/94/ce/bd94ce28cf8aefb521bac31d547f6409.jpg"></a>
      </div>
      <button type="button" class="create" data-toggle="modal" data-target="#exampleModalCenter">
        Login
      </button>
    </div>
    <!--------------------------->
  </nav>
</header>


<body>
  <?= $this->renderSection('content'); ?>
</body>
<script src="/assets/js/script.js"></script>
<script src="/assets/js/modal.js"></script>
<script src="/vendor/modal/jquery.min.js"></script>
<script src="/vendor/modal/popper.js"></script>
<script src="/vendor/modal/bootstrap.min.js"></script>
<script src="/vendor/modal/main.js"></script>

</html>