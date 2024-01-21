<!DOCTYPE html>
<html>

<head>
  <title>Harmonify</title>
  <link rel="stylesheet" href="/assets/css/styles.css" />
  <link rel="stylesheet" href="/assets/css/stylesProfile.css" />
  <link rel="stylesheet" href="/assets/css/modal.css" />
  <link rel="stylesheet" href="/assets/css/post.css" />
  <link rel="stylesheet" href="/assets/css/imagepreview.css" />
  <link rel="stylesheet" href="/assets/css/form.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
  <link rel="icon" type="image/x-icon" href="/image/icon.png">
  <!-- <link href="/assets/filepond/css/filepond.min.css" rel="stylesheet">
  <link href="/assets/filepond/css/filepond-plugin-image-preview.min.css" rel="stylesheet"> -->




  <meta charset="UTF-8">
  <meta name="description" content="Free Web tutorials">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="author" content="Ahlfss">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<header>

  <div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <input type="text" class="form-control" placeholder="Username">
                  </div>
                  <div class="form-group mb-3">
                    <input type="password" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="form-control btn btn-customblue rounded submit px-3"><span class="btn-custombluetext">Login</span></button>
                    <p class="mt-3" type="button" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalRegister">
                      Dont Have an account? Register
                    </p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="ModalRegister" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                <h3 class="mb-4 heading">Register</h3>
                <form action="#" class="contact-form">
                  <div class="form-group mb-3">
                    <input type="text" class="form-control" placeholder="Username">
                  </div>
                  <div class="form-group mb-3">
                    <input type="password" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                  <button type="submit" class="form-control btn btn-customblue rounded submit px-3"><span class="btn-custombluetext">Register</span></button>
                  <p class="mt-3" type="button" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalLogin">
                      Already have an account? Login
                    </p>
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
      <a href="/" id="home" class="home displaytext" draggable="false">Home</a>
      <a href="/create" id="create" class="create displaytext" draggable="false">Create</a>
      <a href="/" id="home" class="home displayicon" draggable="false"><i class="fa-solid fa-house fa-xl"></i></a>
      <a href="/create-js" id="create" class="create displayicon" draggable="false"><i class="fa-solid fa-plus fa-xl"></i></a>
      <input id="one" type="text" class="search-bar" placeholder="Search">
      <button id="two" class="search-bar"></button>
      <div class="icon-container">
        <a href="/profile" draggable="false" id="profile"><img draggable="false" class="icon" src="https://i.pinimg.com/564x/bd/94/ce/bd94ce28cf8aefb521bac31d547f6409.jpg"></a>
      </div>
      <button type="button" class="create" data-toggle="modal" data-target="#ModalLogin">
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
<script src="/assets/js/imagepreview.js"></script>
<script src="/vendor/modal/jquery.min.js"></script>
<script src="/vendor/modal/popper.js"></script>
<script src="/vendor/modal/bootstrap.min.js"></script>
<script src="/vendor/modal/main.js"></script>
<script src="https://kit.fontawesome.com/6d2fa4f343.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  $(document).ready(function() {
    // Menambahkan kelas saat tombol "Tambah Kelas" diklik
    if (localStorage.getItem('highlightHome') === 'true') {
      $("#home").addClass("home-active");
      $("#home").removeClass("home-deactive");
      $("#create").removeClass("create-active");
      $("#create").addClass("cretae-deactive");
      localStorage.setItem('highlightHome', 'true');
      localStorage.setItem('highlightCreate', 'false');
      localStorage.setItem('highlightProfile', 'false');
    }

    if (localStorage.getItem('highlightCreate') === 'true') {
      $("#create").addClass("create-active");
      $("#create").removeClass("create-deactive");
      $("#home").removeClass("home-active");
      $("#home").addClass("home-deactive");
      localStorage.setItem('highlightCreate', 'true');
      localStorage.setItem('highlightHome', 'false');
      localStorage.setItem('highlightProfile', 'false');
    }

    if (localStorage.getItem('highlightProfile') === 'true') {
      $("#create").removeClass("create-active");
      $("#create").addClass("create-deactive");
      $("#home").removeClass("home-active");
      $("#home").addClass("home-deactive");
      localStorage.setItem('highlightCreate', 'false');
      localStorage.setItem('highlightHome', 'false');
      localStorage.setItem('highlightProfile', 'true');
    }

    $("#home").on("click", function() {
      $("#home").addClass("home-active");
      $("#home").removeClass("home-deactive");
      $("#create").removeClass("create-active");
      $("#create").addClass("create-deactive");
      localStorage.setItem('highlightHome', 'true');
      localStorage.setItem('highlightCreate', 'false');
      localStorage.setItem('highlightProfile', 'false');
    });

    // Menghapus kelas saat tombol "Hapus Kelas" diklik
    $("#create").on("click", function() {
      $("#create").addClass("create-active");
      $("#create").removeClass("create-deactive");
      $("#home").removeClass("home-active");
      $("#home").addClass("home-deactive");
      localStorage.setItem('highlightCreate', 'true');
      localStorage.setItem('highlightHome', 'false');
    });

    $("#profile").on("click", function() {
      $("#create").removeClass("create-active");
      $("#create").addClass("create-deactive");
      $("#home").removeClass("home-active");
      $("#home").addClass("home-deactive");
      localStorage.setItem('highlightCreate', 'false');
      localStorage.setItem('highlightHome', 'false');
      localStorage.setItem('highlightProfile', 'true');
    });

    // Hapus data dari localStorage saat pengguna mengclose saja, pindah halaman masih tetap ada
    $(window).on('beforeunload', function() {
      localStorage.addItem('highlightHome');
      localStorage.removeItem('highlightCreate');
      localStorage.removeItem('highlightProfile');
    });

  });
</script>

</html>