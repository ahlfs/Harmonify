<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<div class="photobar">
      <div class="row">
        <div class="col-6">
          <div class="profilefotobar">
            <img src="/user_profile/<?= $user['FotoProfil']; ?>" alt="" class="profilefoto" draggable="false">
          </div>
        </div>
        <div class="col-6 mt-1">
          <div class="namalengkap">
            <?= $user['NamaLengkap'] ?>
          </div>
          <div class="username">
            <p>@<?= $user['Username'] ?></p>
          </div>

          <ul class="flex-menu" style="padding: 0; margin-left: 3px;">
            <li><strong><?= $jumlahfoto ?></strong> posts</li>
          </ul>
          <div class="managebar">
            <?php if (session()->get('UserID') == $user['UserID']) : ?>
              <a href="#" class="editButton">Edit</a>
              <a href="/logout" class="editButton">Logout</a>
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
<div class="box">
  <div class="photobar">
    <a href="/profile/<?= $user['UserID']; ?>" class="no-decoration no-underline photoButtonCreated"><i class="fa-solid fa-table-cells-large" style="color: #63E6BE;"></i> Created</a>
    <a href="/profile/<?= $user['UserID']; ?>/liked" class="underline no-decoration photoButtonSaved selected"><i class="fa-solid fa-heart" style="color: #ff0000;"></i> Like</a>
    <a href="/profile/<?= $user['UserID']; ?>/album" class="no-decoration no-underline photoButtonAlbum"><i class="fa-solid fa-folder" style="color: #74C0FC;"></i> Album</a>
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