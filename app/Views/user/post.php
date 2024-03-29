<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/css/comment.css" />

<?php
$isLogin = session()->get('isLogin');
$posttoalbumFailed = session()->getFlashdata('posttoalbumFailed');
$posttoalbumSuccess = session()->getFlashdata('posttoalbumSuccess');
?>







<div class="container">
  <div class="row">
    <div class="col colku1">
      <div class="window boxshadowpost">
        <img class="foto" src="/image_storage/<?= $fotodata['Foto']; ?>" alt="">
        <div class="hover-zone">
          <div class="top-bar">
          </div>
          <!-------------------->
          <div class="bottom-bar">
            <?php if (!empty($fotodata['Url'])) : ?>
              <a href="<?= $fotodata['Url']; ?>" class="webButton" target="_blank">
                <?= $url ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>


    <div class="col colku2">
      <!-- buatlah sebuah kolom komentar seperti aplikasi instagram -->
      <div class="containerPost border-mix melengkung">
        <div class="row">
          <div class="col-12">
            <div class="display-flex">
              <a href="/profile/<?= $user['UserID'] ?>" draggable="false"><img tabindex="1" draggable="false" class="iconpost pp" src="/user_profile/<?= $user['PhotoProfile'] ?>"></a>
              <span class="centerprofilepost mx-2 mt-3"><?= $user['Username'] ?></span>
              <div class="ms-auto mt-3">
                <?php if (session()->get('UserID') == $user['UserID']) : ?>
                  <a onclick="confirmEdit('/editpost/<?= $fotodata['FotoID'] ?>')" class="editButton"><i class="fa-solid fa-pencil fa-xl" style="color: white;"></i></a>
                  <a onclick="confirmDelete('/deletepost/<?= $fotodata['FotoID'] ?>')" class="deleteButton"><i class="fa-solid fa-trash fa-xl" style="color: white;"></i></a>
                <?php endif; ?>
                <?php if ($isLogin == True) : ?>
                  <a onclick="confirma('/addposttoalbum/<?= $fotodata['FotoID'] ?>/')" class="albumButton"><i class="fa-solid fa-bookmark fa-xl" style="color: white;"></i></a>
                <?php endif; ?>
              </div>
            </div>
            <h3 class="mt-3"><?= $fotodata['JudulFoto']; ?></h3>
            <p><?= $fotodata['DeskripsiFoto']; ?></p>
            <p style="opacity: 0.5;"><?= $fotodata['TanggalUnggah']; ?></p>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-12 mb-3">
            <?php if ($liked) : ?>
              <a href="/unlike/<?= $fotodata['FotoID'] ?>" class="iconButtonLike"><i class="fa-solid fa-heart fa-xl" style="color: #ff0000;"></i><?= $jumlahlike ?></a>
            <?php else : ?>
              <a href="/like/<?= $fotodata['FotoID'] ?>" class="iconButtonLike" style="opacity: 0.7;"><i class="fa-regular fa-heart fa-xl"></i><?= $jumlahlike ?></a>
            <?php endif; ?>
            <a href="/download/<?= $fotodata['FotoID'] ?>" class="iconButtonDownload"><i class="fa-solid fa-download fa-xl"></i></a>
          </div>

          <?php if ($isLogin == True) : ?>

            <div class="col-12">
              <form action="/komentar/<?= $fotodata['FotoID'] ?>" method="post">
                <?= csrf_field(); ?>
                <div class="input-group mb-3">
                  <input type="text" autocomplete="off" class="form-control" placeholder="Komentar" name="IsiKomentar" id="komentar" required>
                  <div class="input-group-append">
                    <button style="margin-left: 1px;" class="btn btn-outline-primary" type="submit" id="button-addon2"><i class="fa-solid fa-paper-plane fa"></i></button>
                  </div>
                </div>
              </form>
            </div>
          <?php else : ?>
            <div class="col-12">
              <div class="input-group mb-3">
                <input type="text" autocomplete="off" class="form-control" placeholder="Komentar" name="IsiKomentar" id="komentar" value="Oops, you need to login before post a comment" required disabled>
                <div class="input-group-append">
                  <button style="margin-left: 1px;" class="btn btn-outline-primary disabled" type="submit" id="button-addon2"><i class="fa-solid fa-paper-plane fa"></i></button>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>






        <?php if ($komentar) : ?>
          <div class="row">
            <div class="col-12 scrolling">
              <?php foreach ($komentar as $k) : ?>
                <div class="container justify-content-center border-left border-right">
                  <div class="d-flex justify-content-start py-2">
                    <div class="second px-2">
                      <div class="d-flex">


                        <div class="komentarprofile" onclick="redirectToPage('/profile/<?= $k['UserID']; ?>')">
                          <img src="/user_profile/<?= $k['PhotoProfile'] ?>" class="iconkomentar">
                          <span class="textprofile"><?= $k['Username'] ?></span>
                          <?php if ($k['UserID'] == $fotodata['UserID']) : ?>
                            <a class="creatorlogo" draggable="false"><span style="font-size: 10px; color: #fff; font-weight: bold;">Creator</span></a>
                          <?php endif; ?>
                        </div>



                        <div class="ms-auto">
                          <span class="text2"><?= $k['TanggalKomentar'] ?></span>
                        </div>
                      </div>

                      <div class="d-flex">
                      <span class="text1"><?= $k['IsiKomentar'] ?></span>
                      
                      <div class="ms-auto">
                        <?php if (session()->get('UserID') == $k['UserID'] || session()->get('UserID') == $user['UserID']) : ?>
                          <a onclick="deleteComment('<?= $k['KomentarID'] ?>/<?= $user['UserID'] ?>')" class="buttonDeleteComment"><i class="fa-solid fa-trash-can" style="color: white;"></i></a>
                        <?php endif; ?>
                      </div>
                        </div>

                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php else : ?>
          <div class="row">
            <div class="col-12">
              <div class="d-flex justify-content-center">
                <span class="text1">No comments yet</span>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>


  <script>
    function posttoalbumFailed() {
      Swal.fire({
        title: "Failed!",
        text: "Album already contains this post",
      });
    }

    function posttoalbumSuccess() {
      Swal.fire({
        title: "Success!",
        text: "Post added to album",
      });
    }



    function confirma(albumUrl) {
      Swal.fire({
          title: "Choose album",
          input: "select",
          inputOptions: {
            <?php foreach ($album as $a) : ?> "<?php echo $a['AlbumID']; ?>": "<?php echo $a['NamaAlbum']; ?>",
            <?php endforeach; ?>},
          inputPlaceholder: "Select an album",
          showCancelButton: true,
          showDenyButton: true,
          denyButtonColor: "#3085d6",
          denyButtonText: "Create Album",
          inputValidator: (value) => {
            return new Promise((resolve) => {
              if (value === "") {
                resolve("You need to select an album");
              } else {
                const albumUrls = albumUrl + value;
                window.location.href = albumUrls;
              }
            })

          },

        })
        .then((result) => {
          if (result.isDenied) {
            createalbum('/submitalbum/');
          }
        });
    }

    window.onload = function() {
        $("#create").removeClass("create-active");
        $("#create").addClass("create-deactive");
        $("#home").removeClass("home-active");
        $("#home").addClass("home-deactive");
    };
  </script>

  <?php if ($posttoalbumFailed) : ?>
    <script>
      posttoalbumFailed();
    </script>
  <?php elseif ($posttoalbumSuccess) : ?>
    <script>
      posttoalbumSuccess();
    </script>
  <?php endif; ?>

  <?= $this->endSection(); ?>