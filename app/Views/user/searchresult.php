<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<?php

use App\Models\UserModel;

$this->UserModel = new UserModel();
?>

<!--------------------------->


<div class="containerSearch">
    <p class="text-start">You search for "<?= $keyword; ?>"</p>
</div>
<?php if ($akun) : ?>
<div class="containerProfile horizontal-scrolling">
    
    <?php foreach ($akun as $a) : ?>
        <div class="cardprofile" onclick="redirectToPage('/profile/<?= $a['UserID']; ?>')" style="background-color: <?= $a['color'] ?>;" >
            <div class="img">
                <img src="/user_profile/<?= $a['PhotoProfile']; ?>" draggable="false">
            </div>
            <?php if ($a['NamaLengkap']) : ?>
                 <span class="fullname"><?= $a['NamaLengkap'] ?></span>
            <?php else : ?>
                <span class="fullname" style='text-transform: capitalize;'><?= $a['Username'] ?></span>
            <?php endif; ?>
            <p class="username">@<?= $a['Username'] ?></p>
        </div>
        
    <?php endforeach; ?>
          
</div>
<?php endif; ?>

<div class="containerFoto">


    <?php foreach ($foto as $f) : ?>
        <div class="window">
            <img class="foto" src="/image_storage/<?= $f['Foto']; ?>">
            <div class="hover-zone" onclick="redirectToPage('/post/<?= $f['FotoID']; ?>')">
                <div class="top-bar">
                    <?php foreach ($alluser as $u) : if ($f['UserID'] == $u['UserID']) : ?>
                            <a href="/profile/<?= $f['UserID']; ?>"><img tabindex="1" draggable="false" class="icon pp" src="/user_profile/<?= $u['PhotoProfile']; ?>"></a>
                    <?php endif;
                    endforeach; ?>
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
        $("#create").removeClass("create-active");
        $("#create").addClass("create-deactive");
        $("#home").removeClass("home-active");
        $("#home").addClass("home-deactive");
    };
</script>

<?= $this->endSection(); ?>