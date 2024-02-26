<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>


  <main>

    <div class="photobar">
      <div class="row">
        <div class="col-6">
          <div class="profilefotobar">
            <img src="/user_profile/<?= $user['PhotoProfile']; ?>" alt="" class="profilefoto" draggable="false">
          </div>
        </div>
        <div class="col-6 mt-1">
          <div class="namalengkap">
            <?= $user['NamaLengkap'] ?>
            <?php if ($user['NamaLengkap'] == "") : ?>
              <span style='text-transform: capitalize;'><?= $user['Username'] ?></span>
            <?php endif; ?>
          </div>
          <div class="username">
            <p>@<?= $user['Username'] ?></p>
          </div>

          <ul class="flex-menu" style="padding: 0; margin-left: 3px;">
            <li><strong><?= $jumlahfoto ?></strong> posts</li>
          </ul>
          <div class="managebar">
            <?php if (session()->get('UserID') == $user['UserID']) : ?>
              <a href="/editprofile/<?= $user['UserID'] ?>" class="editButton">Edit</a>
              <a onclick="logout('/logout')" class="editButton">Logout</a>
              <a onclick="setting('/changepassword','/changeemail')" class="editButton"><i class="fa-solid fa-gear fa-xl" style="color: #161b22;"></i></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="box">
      <div class="garis"></div>
    </div>
    <div class="box">
      <div class="photobar">
        <a href="/profile/<?= $user['UserID']; ?>" class="underline no-decoration photoButtonCreated selected" draggable="false"><i class="fa-solid fa-table-cells-large" style="color: #63E6BE;"></i> Created</a>
        <a href="/profile/<?= $user['UserID']; ?>/liked" class="no-decoration no-underline photoButtonSaved" draggable="false"><i class="fa-solid fa-heart" style="color: #ff0000;"></i> Like</a>
        <a href="/profile/<?= $user['UserID']; ?>/album" class="no-decoration no-underline photoButtonAlbum" draggable="false"><i class="fa-solid fa-folder" style="color: #74C0FC;"></i> Album</a>
      </div>
    </div>

    <div class="containerFoto">
      <?php foreach ($foto as $f) : ?>
        <div class="window">
          <img class="foto" src="/image_storage/<?= $f['Foto']; ?>">
          <div class="hover-zone" onclick="redirectToPage('/post/<?= $f['FotoID']; ?>')">
            <div class="top-bar">
              <div class="radius-ico mt-1">
                
              </div>
            </div>
            <div class="bottom-bar">
              <div class="radius-ico">
                <a href="/download/<?= $f['FotoID'] ?>" class="iconButtonDownload"><i class="fa-solid fa-download fa-xl"></i></a>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>



    <?= $this->endSection(); ?>