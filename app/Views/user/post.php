<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col colku1">
      <div class="window boxshadowpost">
        <img class="foto" src="/image_storage/<?= $fotodata['Foto']; ?>" alt="">
        <div class="hover-zone" onclick="redirectToPage('/post/<?= $fotodata['FotoID']; ?>')">
          <div class="top-bar">
          </div>
          <!-------------------->
          <div class="bottom-bar">
          <?php if (!empty($fotodata['Url'])) : ?>
          <a href="<?= $fotodata['Url']; ?>" class="webButton">↗ website.com</a>
          <?php endif; ?>
            <div class="radius-ico">
              <a href="#" class="iconButton"><i class="fa-regular fa-heart fa-xl"></i></a>
              <a href="#" class="iconButton"><i class="fa-solid fa-download fa-xl"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col colku2">
      <!-- buatlah sebuah kolom komentar seperti aplikasi instagram -->
      <div class="containerPost border-mix melengkung">
        <div class="row">
          <div class="col-12">
            <div class="display-flex">
          <a href="/profile" draggable="false"><img tabindex="1" draggable="false" class="iconpost pp" src="https://i.pinimg.com/564x/bd/94/ce/bd94ce28cf8aefb521bac31d547f6409.jpg"></a>
          <span class="centerprofilepost mx-2 mt-3">ahlfss</span>
          </div>
            <h3 class="mt-3"><?= $fotodata['JudulFoto']; ?></h3>
            <p><?= $fotodata['DeskripsiFoto']; ?></p>
            <p style="opacity: 0.5;"><?= $fotodata['TanggalUnggah']; ?></p>
          </div>

        </div>

        <div class="row mt-5">
          <div class="col-12">
            <form action="/komentar/" method="post">
              <?= csrf_field(); ?>
              <div class="input-group mb-3">
                <input type="text" autocomplete="off" class="form-control" placeholder="Komentar" name="komentar" id="komentar" required>
                <div class="input-group-append">
                  <button class="btn btn-outline-primary" type="submit" id="button-addon2"><i class="fa-solid fa-paper-plane fa"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>