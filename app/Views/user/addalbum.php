<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>


<div class="container">
    <form action="/submitalbum" method="post">
        <!-- buatlah sebuah kolom komentar seperti aplikasi instagram -->
        <div class="containerPost border-mix melengkung">
            <div class="row">
                <div class="col-12">
                    <div class="form-container">
                        <form class="form">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" name="NamaAlbum" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="DeskripsiAlbum" id="description" rows="10" cols="50" required></textarea>
                            </div>
                            <div class="form-submit">
                                <button type="submit" name="register" class="submit">Post</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>