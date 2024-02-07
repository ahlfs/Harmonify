<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/css/comment.css" />

<?php

$isLogin = session()->get('isLogin');
?>

<div class="container">
  <div class="row">
    <div class="col colku1">
      <div class="window boxshadowpost">
        <img class="foto" src="/image_storage/<?= $fotodata['Foto']; ?>" alt="">
        <div class="hover-zone" onclick="redirectToPage('/post/<?= $fotodata['FotoID']; ?>')">
          <div class="top-bar">
          </div>
          <!-------------------->
          <div class="bottom-bar">
            <?php if (!empty($fotodata['Url'])) : ?>
              <a href="<?= $fotodata['Url']; ?>" class="webButton" target="_blank">
              <?= $url ?>
            </a>
            <?php endif; ?>
            <div class="radius-ico">
              <?php if ($liked) : ?>
                <a href="/unlike/<?= $fotodata['FotoID'] ?>" class="iconButton"><i class="fa-solid fa-heart fa-xl" style="color: #ff0000;"></i></a>
              <?php else : ?>
                <a href="/like/<?= $fotodata['FotoID'] ?>" class="iconButton"><i class="fa-regular fa-heart fa-xl"></i></a>
              <?php endif; ?>
              <a href="/download/<?= $fotodata['FotoID'] ?>" class="iconButton"><i class="fa-solid fa-download fa-xl"></i></a>
            </div>
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
              <a href="/profile/<?= $user['UserID'] ?>" draggable="false"><img tabindex="1" draggable="false" class="iconpost pp" src="/user_profile/<?= $user['FotoProfil'] ?>"></a>
              <span class="centerprofilepost mx-2 mt-3"><?= $user['Username'] ?></span>
            </div>
            <h3 class="mt-3"><?= $fotodata['JudulFoto']; ?></h3>
            <p><?= $fotodata['DeskripsiFoto']; ?></p>
            <p style="opacity: 0.5;"><?= $fotodata['TanggalUnggah']; ?></p>
          </div>
        </div>
        <div class="row mt-5">
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
                      <img src="/user_profile/<?= $k['FotoProfil'] ?>" class="iconkomentar" >
                        <span class="text2"><?= $k['Username'] ?></span>
                        <?php if ($k['UserID'] == $fotodata['UserID']) : ?>
                          <a class="creatorlogo" draggable="false"><span style="font-size: 10px; color: #fff;">Creator</span></a>
                        <?php endif; ?>
                      </div>
                    </div>
                    <span class="text1"><?= $k['IsiKomentar'] ?></span>
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
  <?= $this->endSection(); ?>