<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<!--------------------------->
<div class="containerFoto">
  <?php foreach ($foto as $f) : ?>
    <div class="window">
      <img class="foto" src="/image_storage/<?= $f['Foto']; ?>">
      <div class="hover-zone" onclick="redirectToPage('/post/<?= $f['FotoID']; ?>')">
        
          <div class="top-bar">
            <a href="/profile/<?= $f['UserID']; ?>"><img draggable="false" class="icon" src="/user_profile/<?= $f['PhotoProfile']; ?>"></a>
          </div>
          <!-------------------->
          <div class="bottom-bar">
            <div class="radius-ico">
              <a href="/download/<?= $f['FotoID'] ?>" class="iconButtonDownload"><i class="fa-solid fa-download fa-xl"></i></a>
            </div>
          </div>
     
      </div>
    </div>
  <?php endforeach; ?>

</div>

<script>
    window.onload = function() {
        $("#home").addClass("home-active");
        $("#home").removeClass("home-deactive");
        $("#create").removeClass("create-active");
        $("#create").addClass("create-deactive");
    };
</script>

<?= $this->endSection(); ?>