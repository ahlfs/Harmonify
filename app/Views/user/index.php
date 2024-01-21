<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>



  <!--------------------------->
  <div class="containerFoto">

  <?php foreach ($foto as $f) : ?>
    <div class="window">
      <img class="foto" src="/image_storage/<?= $f['Foto']; ?>">
      <div class="hover-zone" onclick="redirectToPage('/post/<?= $f['FotoID']; ?>')" >
        <div class="top-bar">
          <a href="/profile"><img tabindex="1" draggable="false" class="icon pp" src="https://i.pinimg.com/564x/bd/94/ce/bd94ce28cf8aefb521bac31d547f6409.jpg"></a>
        </div>
        <!-------------------->
        <div class="bottom-bar">
        
          <div class="radius-ico">
            <a href="#" class="iconButton"><i class="fa-solid fa-download fa-xl"></i></a>
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

  </div>
    
  <?= $this->endSection(); ?>
