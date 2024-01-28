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
    <a href="/profile/<?= $user['UserID']; ?>" class="no-decoration no-underline photoButtonSaved">Created</a>
    <a href="/profile/<?= $user['UserID']; ?>/liked" class="no-decoration no-underline photoButtonSaved">Like</a>
    <a href="/profile/<?= $user['UserID']; ?>/album" class="underline no-decoration photoButtonCreated selected">Album</a>
  </div>
</div>




<?= $this->endSection(); ?>