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
                <img class="foto" src="/image_storage/<?= $f['Foto']; ?>">
                <div class="hover-zone" onclick="redirectToPage('/post/<?= $f['FotoID']; ?>')">
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
<?php else : ?>
    <div class="containerFoto">
        <p class="text-start">No photo found</p>
    </div>
<?php endif; ?>


<?= $this->endSection(); ?>