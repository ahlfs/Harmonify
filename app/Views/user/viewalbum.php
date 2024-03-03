<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>


<!--------------------------->


<div class="containerSearch">
</div>



<?php if ($foto) : ?>
    <div class="containerFoto">
        <?php foreach ($foto as $f) : ?>
            <?php
            ?>
            <div class="window">
                <img class="foto" src="/image_storage/<?= $f['Foto']; ?>" onclick="redirectToPage('/post/<?= $f['FotoID']; ?>')">
                <div class="hover-zone-album" >
                    <div class="bottom-bar">
                        <div class="radius-ico">
                            <a onclick="removeFromAlbum('<?= $album[0]['AlbumID'] ?>/<?= $f['FotoID'] ?>')" class="iconButtonRemove"><i class="fa-solid fa-trash fa-xl"></i></i></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <div class="containerFoto">
        <p class="text-start">No photo found</p>
    </div>
<?php endif; ?>

<script>
    function removeFromAlbum($id) {
  Swal.fire({
    title: "Are you sure",
    text: "You want to remove this post from album",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    confirmButtonText: "Yes, remove it!",
  }).then((result) => {
    if (result.value) {
      const removeUrl = '/removefromalbum/' + $id;
      window.location.href = removeUrl;
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





<?= $this->endSection(); ?>