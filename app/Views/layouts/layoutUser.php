<!DOCTYPE html>
<html>

<head>
  <title>Harmonify</title>
  <link rel="stylesheet" href="/assets/css/styles.css" />
  <link rel="stylesheet" href="/assets/css/stylesProfile.css" />
  <link rel="stylesheet" href="/assets/css/modal.css" />
  <link rel="stylesheet" href="/assets/css/post.css" />


  <link rel="stylesheet" href="/assets/css/form.css" />

  <link rel="stylesheet" href="/assets/css/searchresult.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
  <link rel="icon" type="image/x-icon" href="/image/icon.png">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/assets/js/alert.js"></script>





  <meta charset="UTF-8">
  <meta name="description" content="Gallery Website">
  <meta name="keywords" content="HTML, CSS, PHP, JavaScript">
  <meta name="author" content="Ahlfss">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<?php
$isLogin = session()->get('isLogin');
$ProfileID = session()->get('UserID');
$ProfilePhoto = session()->get('PhotoProfile');
$LoginFailed = session()->getFlashdata('LoginFailed');
$Email = session()->getFlashdata('Email');
$EmailVerification = session()->getFlashdata('EmailVerification');
$EmailVerified = session()->getFlashdata('EmailVerified');
$ForgotPasswordFailed = session()->getFlashdata('ForgotPasswordFailed');
$ForgotEmailError = session()->getFlashdata('ForgotEmailError');
$LoginUsernameError = session()->getFlashdata('usernameNotFound');
$LoginPasswordError = session()->getFlashdata('passwordWrong');
$RegisterFailed = session()->getFlashdata('RegisterFailed');
$RegisterUsernameError = session()->getFlashdata('usernameError');
$RegisterPasswordError = session()->getFlashdata('passwordError');
$RegisterConfirmError = session()->getFlashdata('confirmError');
$RegisterEmailError = session()->getFlashdata('emailError');
$notifSuccess = session()->getFlashdata('notifSuccess');
?>


<div class="modal fade" id="ModalLogin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="ion-ios-close"><i class="fa-solid fa-xmark fa-xl"></i></span>
        </button>
      </div>
      <div class="row no-gutters">
        <div class="col-md-12 d-flex">
          <div class="modal-body p-4 p-md-5 d-flex align-items-center color-1">
            <div class="text w-100 py-3">
              <span class="subheading">Welcome to Harmonify</span>
              <h3 class="mb-4 heading">Login to continue</h3>
              <form action="/login" method="post">
                <p class="text-success"><?= $EmailVerified ?></p>
                <div class="form-group">
                  <p class="text-danger"><?= $LoginUsernameError ?></p>
                  <input type="text" class="form-control" name="usernameLogin" placeholder="Username" autocomplete="off" value="<?= old('usernameLogin') ?>">
                </div>
                <div class="form-group">
                  <p class="text-danger"><?= $LoginPasswordError ?></p>
                  <div class="input-group">
                    <input type="password" class="form-control" id="password" name="passwordLogin" placeholder="Password" value="<?= old('passwordLogin') ?>">
                    <button class="btn" style="color: white; width: 10px;" type="button" id="togglePassword">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <div class="display-flex justify-content-center">
                    <button type="submit" class="form-control btn btn-customblue rounded submit px-3"><span class="btn-custombluetext">Login</span></button>
                  </div>
                  <p type="button" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalForgot">
                    Forget your password? Change
                  </p>

                  <p type="button" data-dismiss="modal" id="RegisterModal" aria-label="Close" data-toggle="modal" data-target="#ModalRegister">
                    Don't Have an account? Register
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

        <div class="col-md-12 d-flex">
          <div class="modal-body p-4 p-md-5 d-flex align-items-center color-1">
            <div class="text w-100 py-3">
              <span class="subheading">Welcome to Harmonify</span>
              <h3 class="mb-4 heading">Register</h3>
              <form action="/register" method="post">

                <div class="form-group">
                  <p class="text-danger"><?= $RegisterUsernameError ?></p>
                  <input type="text" class="form-control" name="usernameRegister" placeholder="Username" autocomplete="off" value="<?= old('usernameRegister') ?>">
                </div>

                <div class="form-group">
                  <p class="text-danger"><?= $RegisterPasswordError ?></p>
                  <div class="input-group">
                    <input type="password" id="passwordRegister" class="form-control" name="passwordRegister" placeholder="Password" value="<?= old('passwordRegister') ?>">
                    <button class="btn" style="color: white; width: 10px;" type="button" id="togglePasswordRegister">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
                <div class="form-group">
                  <p class="text-danger"><?= $RegisterConfirmError ?></p>
                  <div class="input-group">
                    <input type="password" class="form-control" id="passwordConfirm" name="confirmRegister" placeholder="Confirm Password" value="<?= old('confirmRegister') ?>">
                    <button class="btn" style="color: white; width: 10px;" type="button" id="togglePasswordConfirm">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
                <div class="form-group">
                  <p class="text-danger"><?= $RegisterEmailError ?></p>
                  <div class="input-group">
                    <input type="email" class="form-control" name="emailRegister" placeholder="Email" autocomplete="off" value="<?= old('emailRegister') ?>">
                  </div>
                </div>
                <div class="form-group mt-3">
                  <div class="display-flex justify-content-center">
                    <button type="submit" class="form-control btn btn-customblue btn-custombluetext rounded submit px-3">Register</button>
                  </div>
                  <p type="button" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalLogin">
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

<div class="modal fade" id="ModalForgot" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="ion-ios-close"><i class="fa-solid fa-xmark fa-xl"></i></span>
        </button>
      </div>
      <div class="row no-gutters">

        <div class="col-md-12 d-flex">
          <div class="modal-body p-4 p-md-5 d-flex align-items-center color-1">
            <div class="text w-100 py-3">
              <span class="subheading">Welcome to Harmonify</span>
              <h3 class="mb-4 heading">Forget Password</h3>
              <form action="/forgotpassword" method="post">
                <div class="form-group">
                  <p class="text-danger"><?= $ForgotEmailError ?></p>
                  <div class="input-group">
                    <input type="email" class="form-control" name="email" placeholder="Email" autocomplete="off" value="<?= old('email') ?>">
                  </div>
                </div>
                <div class="form-group mt-3">
                  <div class="display-flex justify-content-center">
                    <button type="submit" class="form-control btn btn-customblue btn-custombluetext rounded submit px-3">Send</button>
                  </div>
                  <p type="button" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#ModalLogin">
                    Remember your password? Login
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

<div class="modal fade" id="ModalVerification" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close d-flex align-items-center justify-content-center" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="ion-ios-close"><i class="fa-solid fa-xmark fa-xl"></i></span>
        </button>
      </div>
      <div class="row no-gutters">
        <div class="col-md-6 d-flex">
          <div class="modal-body p-5 img d-flex text-center d-flex align-items-center" style="background-image: url(https://i.pinimg.com/564x/34/7a/2a/347a2a4ab565bfe4090bb0f76fc38a97.jpg);">
          </div>
        </div>
        <div class="col-md-6 d-flex">
          <div class="modal-body p-4 p-md-5 d-flex align-items-center color-1">
            <div class="text w-100 py-3">
              <span class="subheading">Please verify your email</span>
              <h3 class="mb-4 heading">we've sent it at <?= $Email ?></h3>
            </div>
          </div>
          <p style="display: none;" type="button" data-dismiss="modal" id="VerificationModal" aria-label="Close" data-toggle="modal" data-target="#ModalVerification">
            Don't Have an account? Register
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<header style="z-index: 1000;">
  <nav>
    <div class="menu">
      <img draggable="false" class="harmonify-icon" src="/image/icon.png">
      <a href="/" id="home" class="home displaytext" draggable="false">Home</a>
      <a href="/create" id="create" class="create displaytext" draggable="false">Create</a>
      <a href="/" id="home" class="homeicon displayicon" style="color: #161b22" draggable="false"><i class="fa-solid fa-house fa-xl"></i></a>
      <a href="/create" id="create" style="color: #161b22" class="createicon displayicon" draggable="false"><i class="fa-solid fa-plus fa-xl"></i></a>
      <div class="full-search-bar">
        <form method="post" action="/search">
          <?php if (!empty($keyword)) : ?>
            <input id="one" type="text" class="search-bar" name="keyword" value="<?= $keyword ?>" placeholder="Search anything" autocomplete="off">
          <?php else : ?>
            <input id="one" type="text" class="search-bar" name="keyword" placeholder="Search anything" autocomplete="off">
          <?php endif; ?>
        </form>
      </div>
      <?php if ($isLogin == true) : ?>
        <div class="icon-container">
          <a href="/profile/<?= $ProfileID ?>" draggable="false" id="profile"><img draggable="false" class="icon" src="/user_profile/<?= $ProfilePhoto ?>"></a>
        </div>
      <?php else : ?>
        <button type="button" class="buttonlogin" data-toggle="modal" id="LoginModal" data-target="#ModalLogin">Login
          <div class="arrow-wrapper">
            <div class="arrow"></div>
          </div>
        </button>
      <?php endif; ?>
    </div>
    <!--------------------------->
  </nav>
</header>


<body class="px-0">
  <?= $this->renderSection('content'); ?>
</body>
<script src="/assets/js/script.js"></script>
<script src="/assets/js/modal.js"></script>




<script src="/vendor/modal/jquery.min.js"></script>
<script src="/vendor/modal/popper.js"></script>
<script src="/vendor/modal/bootstrap.min.js"></script>
<script src="/vendor/modal/main.js"></script>
<script src="https://kit.fontawesome.com/6d2fa4f343.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<script>
  $(document).ready(function() {

    $("#home").on("click", function() {
      $("#home").addClass("home-active");
      $("#home").removeClass("home-deactive");
      $("#create").removeClass("create-active");
      $("#create").addClass("create-deactive");
      localStorage.setItem('highlightHome', 'true');
      localStorage.setItem('highlightCreate', 'false');
      localStorage.setItem('highlightProfile', 'false');
    });

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

    // Untuk Toggle Password Visibility pada Login dan Register
    $('#togglePassword').on('click', function() {
      const passwordField = $('#password');
      const passwordFieldType = passwordField.attr('type');

      if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
        $('#togglePassword i').removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordField.attr('type', 'password');
        $('#togglePassword i').removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });

    $('#togglePasswordRegister').on('click', function() {
      const passwordField = $('#passwordRegister');
      const passwordFieldType = passwordField.attr('type');

      if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
        $('#togglePasswordRegister i').removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordField.attr('type', 'password');
        $('#togglePasswordRegister i').removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });

    $('#togglePasswordConfirm').on('click', function() {
      const passwordField = $('#passwordConfirm');
      const passwordFieldType = passwordField.attr('type');

      if (passwordFieldType === 'password') {
        passwordField.attr('type', 'text');
        $('#togglePasswordConfirm i').removeClass('fa-eye').addClass('fa-eye-slash');
      } else {
        passwordField.attr('type', 'password');
        $('#togglePasswordConfirm i').removeClass('fa-eye-slash').addClass('fa-eye');
      }
    });

  });
</script>

<?php if ($LoginFailed) : ?>
  <script>
    $(document).ready(function() {
      $('#LoginModal').trigger('click');
    });
  </script>
<?php elseif ($RegisterFailed) : ?>
  <script>
    $(document).ready(function() {
      $('#RegisterModal').trigger('click');
    });
  </script>
<?php elseif ($EmailVerification) : ?>
  <script>
    $(document).ready(function() {
      $('#VerificationModal').trigger('click');
    });
  </script>
<?php elseif ($ForgotPasswordFailed) : ?>
  <script>
    $(document).ready(function() {
      $('#VerificationModal').trigger('click');
    });
  </script>
<?php elseif ($notifSuccess) : ?>
  <script>
   const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.onmouseenter = Swal.stopTimer;
      toast.onmouseleave = Swal.resumeTimer;
    }
  });
  Toast.fire({
    icon: "success",
    title: "<?= $notifSuccess ?>"
  });
  </script>
<?php endif; ?>




</html>