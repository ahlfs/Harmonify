<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/css/imagepreview.css" />

<div class="container">
    <form action="/upload" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col colku1">
                <!-- Image Preview -->
                <div id="img-preview"></div>
                <!-- Input Images -->
                <label for="foto" id="drop-area">
                    <input type="file" accept="image/*" id="foto" name="foto" hidden />
                    <div id="img-view">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="mt-4"><i class="fa-solid fa-cloud-arrow-up fa-xl"></i></h5>
                            </div>
                            <div class="col-12">
                                <div class="displaydrag">
                                    <h5 class="mt-1" style="font-size: 15px; display: flex; justify-content: center;"> Drag and drop or click here <br> to upload image </h5>
                                </div>
                                <div class="nodisplaydrag">
                                    <h5 class="mt-1" style="font-size: 15px; display: flex; justify-content: center;"> Browse file</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
            <div class="col colku2">
                <!-- buatlah sebuah kolom komentar seperti aplikasi instagram -->
                <div class="containerPost border-mix melengkung">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-container">
                                <form class="form">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" id="title" name="JudulFoto" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="DeskripsiFoto" id="description" rows="10" cols="50" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Url</label>
                                        <input type="text" id="url" name="Url" autocomplete="off">
                                    </div>
                                    <div class="form-submit">
                                    <button type="submit" name="register" class="submit">Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="/assets/js/imagepreview.js"></script>
<?= $this->endSection(); ?>

