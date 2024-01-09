<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row">
    <div class="col-4">
      <div class="window">
        <img class="foto" src="https://i.pinimg.com/736x/47/5e/ba/475eba57454015bfe214e8722e2422a1.jpg" alt="">
        <div class="hover-zone" onclick="redirectToPage('/post')">
          <div class="top-bar">
            <a href="#" class="saveButton">Save</a>
          </div>
          <!-------------------->
          <div class="bottom-bar">
            <a href="#" class="webButton">↗ website.com</a>
            <div class="radius-ico">
              <a href="#" class="iconButton"><i class="fa-regular fa-heart fa-xl"></i></a>
              <a href="#" class="iconButton"><i class="fa-solid fa-download fa-xl"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-8">
      <!-- buatlah sebuah kolom komentar seperti aplikasi instagram -->
      <div class="containerPost border-mix melengkung">
        <div class="row">
          <div class="col-12">
            <div class="display-flex">
          <a href="/profile"><img tabindex="1" draggable="false" class="iconpost pp" src="https://i.pinimg.com/564x/bd/94/ce/bd94ce28cf8aefb521bac31d547f6409.jpg"></a>
          Hai
          </div>
            <h3 class="mt-3">Title</h3>
            <p>Description</p>
          </div>

        </div>

        <div class="row mt-5">
          <div class="col-12">
            <form action="/komentar/" method="post">
              <?= csrf_field(); ?>
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Komentar" name="komentar" id="komentar">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Kirim</button>
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