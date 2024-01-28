<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<div class="box">
  <div class="profilefotobar">
    <img draggable="false" class="profilefoto" src="/user_profile/<?= $user['FotoProfil']; ?>">
  </div>
  <div class="profilebar">
    <h5></h5>
    <p class="username">@<?= $user['Username']; ?></p>
    <p class="count"><?= $jumlahfoto ?> photo</p>
  </div>
  <div class="managebar">
    <a href="#" class="shareButton">Share</a>
    <?php if (session()->get('UserID') == $user['UserID']) : ?>
      <a href="#" class="editButton">Edit</a>
      <a href="/logout" class="editButton">Logout</a>
    <?php endif; ?>
  </div>
</div>
<div class="box">
  <div class="garis"></div>
</div>
<div class="box">
  <div class="photobar">
    <a href="/profile/<?= $user['UserID']; ?>" class="no-decoration no-underline photoButtonCreated">Created</a>
    <a href="/profile/<?= $user['UserID']; ?>/liked" class="underline no-decoration photoButtonSaved selected">Like</a>
    <a href="/profile/<?= $user['UserID']; ?>/album" class="no-decoration no-underline photoButtonAlbum">Album</a>
  </div>
</div>

<div class="containerFoto">
  <?php foreach ($foto as $f) : ?>
    <div class="window">
      <img class="foto" src="/image_storage/<?= $f['Foto']; ?>">
      <div class="hover-zone" onclick="redirectToPage('/post/<?= $f['FotoID']; ?>')">
        <div class="bottom-bar">
          <div class="radius-ico">
            <a href="/download/<?= $f['FotoID'] ?>" class="iconButton"><i class="fa-solid fa-download fa-xl"></i></a>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>

</div>



<?= $this->endSection(); ?>