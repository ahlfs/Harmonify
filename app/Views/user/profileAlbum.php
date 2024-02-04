<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<div class="box">
  <div class="profilefotobar">
    <img draggable="false" class="profilefoto" src="/user_profile/<?= $user['FotoProfil']; ?>">
  </div>
  <div class="profilebar">
    <h5 class="mt-2"><?= $user['NamaLengkap'] ?></h5>
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

<div class="d-flex justify-content-center mt-4">

  <a href="/addalbum">
    <button class="buttonalbum" type="button">
      <span class="button__text">Add Album</span>
      <span class="button__icon"><svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
          <line x1="12" x2="12" y1="5" y2="19"></line>
          <line x1="5" x2="19" y1="12" y2="12"></line>
        </svg></span>
    </button>
  </a>
</div>

<div class="containerFoto">
  <?php foreach ($album as $a) : ?>
    <a href="/profile/album/<?= $a['AlbumID']; ?>">
      <button class="listalbum">
        <svg class="svg-icon" width="24" viewBox="0 0 24 24" height="24" fill="none">
          <g stroke-width="2" stroke-linecap="round" stroke="#056dfa" fill-rule="evenodd" clip-rule="evenodd">
            <path d="m3 7h17c.5523 0 1 .44772 1 1v11c0 .5523-.4477 1-1 1h-16c-.55228 0-1-.4477-1-1z"></path>
            <path d="m3 4.5c0-.27614.22386-.5.5-.5h6.29289c.13261 0 .25981.05268.35351.14645l2.8536 2.85355h-10z"></path>
          </g>
        </svg>
        <span class="lable"><?= $a['NamaAlbum'] ?></span>
      </button>
    </a>
  <?php endforeach; ?>

</div>




<?= $this->endSection(); ?>