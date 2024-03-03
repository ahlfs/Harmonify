<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

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
    <a href="/profile/<?= $user['UserID']; ?>" class="no-decoration no-underline photoButtonSaved" draggable="false"><i class="fa-solid fa-table-cells-large" style="color: #63E6BE;"></i> Created</a>
    <a href="/profile/<?= $user['UserID']; ?>/liked" class="no-decoration no-underline photoButtonSaved" draggable="false"><i class="fa-solid fa-heart" style="color: #ff0000;"></i> Like</a>
    <a href="/profile/<?= $user['UserID']; ?>/album" class="underline no-decoration photoButtonCreated selected" draggable="false"><i class="fa-solid fa-folder" style="color: #74C0FC;"></i> Album</a>
  </div>
</div>

<?php if (session()->get('UserID') == $user['UserID']) : ?>
  <div class="d-flex justify-content-center mt-4">

    <button class="buttonalbum" type="button" onclick="createalbum('/submitalbum/')">
      <span class="button__text">Add Album</span>
      <span class="button__icon"><svg class="svg" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
          <line x1="12" x2="12" y1="5" y2="19"></line>
          <line x1="5" x2="19" y1="12" y2="12"></line>
        </svg></span>
    </button>

  </div>
<?php endif; ?>

<div class="containerAlbum">
  <?php if (empty($album)) : ?>
    <p class="text-center">Album is empty</p>
  <?php endif; ?>
  <?php foreach ($album as $a) : ?>
    <div class="cardalbum" onclick="redirectToPage('/profile/album/<?= $a['AlbumID']; ?>')" style="background: <?= $a['color'] ?>;">
      <div class="titlezone">
        <span class="title"><?= $a['NamaAlbum']; ?></span>
        <span class="icon" onclick="openAlbumSetting('<?= $a['AlbumID'] ?>', '<?= $a['NamaAlbum'] ?>')"><i class="fa-solid fa-ellipsis-vertical fa-xl"></i></span>
      </div>
      <?php if ($a['foto'] != 'false') : ?>
        <div class="imagezone">
          <div class="image"><img src="/image_storage/<?= $a['foto']; ?>" draggable="false"></div>
        </div>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>


<script>
  function openAlbumSetting($id, $albumname) {
    event.stopPropagation();
    albumSetting($id, $albumname);
  }


  function albumSetting($id, $albumname) {
    Swal.fire({
      title: "Setting Album",
      showDenyButton: true,
      confirmButtonText: "<i class='fa-solid fa-pen fa-xl'></i> Edit",
      confirmButtonColor: "#3085d6",
      denyButtonText: "<i class='fa-solid fa-trash fa-xl'></i> Delete",
      denyButtonColor: "FF8080",

    }).then((result) => {
      if (result.isConfirmed) {
        editalbum($id, $albumname);
      } else if (result.isDenied) {
        deletealbum($id, $albumname);
      }
    });
  }

  function deletealbum($id, $albumname) {
  Swal.fire({
    title: "Are you sure",
    text: "You want to delete album " + $albumname + " ?",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
      const deleteUrl = '/deletealbum/' + $id;
      window.location.href = deleteUrl;
    }
  });
}

function editalbum($id, $albumname) {
  Swal.fire({
    input: "text",
    title: "Edit Album",
    inputPlaceholder: "Enter album name...",
    showCancelButton: true,
    confirmButtonText: "Update",
    cancelButtonText: "Cancel",
    inputAttributes: {
      autocomplete: "off"
    },
    inputValue: $albumname,
    
    inputValidator: (value) => {
      if (value == null || value == "" || value == " ") {
        resolve("You need to enter an album name");
      } else {
        const editUrl = '/editalbum/' + $id;
        window.location.href = editUrl + '/' + value;
      }
    },
  }); 
}

window.onload = function() {
        $("#create").removeClass("create-active");
        $("#create").addClass("create-deactive");
        $("#home").removeClass("home-active");
        $("#home").addClass("home-deactive");
    };
</script>





<?= $this->endSection(); ?>