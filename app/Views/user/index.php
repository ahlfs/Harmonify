<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<?php 
use App\Models\UserModel;
$this->UserModel = new UserModel();
?>

  <!--------------------------->
  <div class="containerFoto">
  <?php foreach ($foto as $f) : ?>
    <?php
      $user = $this->UserModel->getUser($f['UserID']);
      ?>
    <div class="window">
      <img class="foto" src="/image_storage/<?= $f['Foto']; ?>">
      <div class="hover-zone" onclick="redirectToPage('/post/<?= $f['FotoID']; ?>')" >
        <div class="top-bar">
          <a href="/profile/<?= $f['UserID']; ?>"><img tabindex="1" draggable="false" class="icon pp" src="/user_profile/<?= $user['FotoProfil']; ?>"></a>
        </div>
        <!-------------------->
        <div class="bottom-bar">
          <div class="radius-ico">
            <a href="/download/<?= $f['FotoID']?>" class="iconButton"><i class="fa-solid fa-download fa-xl"></i></a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
    
  <?= $this->endSection(); ?>
