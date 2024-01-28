<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/css/imagepreviewprofile.css" />

<div class="container">
    <form action="/updateprofile/<?= $user['UserID'] ?>" method="post" enctype="multipart/form-data">
        <div class="containerPost border-mix melengkung">
            <div class="fotoprofile d-flex justify-content-center">
                <label for="foto" id="drop-area-profile">
                    <input type="file" accept="image/*" id="foto" name="foto" hidden />
                    <div id="img-view-profile">
                        <div id="img-preview-profile"></div>
                    </div>
                </label>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-detail">
                        <div class="form-row">
                            <input autocomplete="off" type="text" name="Username" class="input-text" placeholder="Username" value="<?= $user['Username'] ?>" required>
                        </div>
                        <div class="form-row">
                            <input autocomplete="off" type="text" name="NamaLengkap" class="input-text" placeholder="Nama Lengkap" value="<?= $user['NamaLengkap'] ?>" required>
                        </div>
                        <div class="form-row">
                            <input autocomplete="off" type="text" name="Email" class="input-text" placeholder="Email Address" value="<?= $user['Email'] ?>" required>
                        </div>
                        <div class="form-row">
                            <input autocomplete="off" type="text" name="Alamat" class="input-text" placeholder="Address" value="<?= $user['Alamat'] ?>">
                        </div>
                        <div class="form-row-last">
                            <button type="submit" name="register" class="submit">Update Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="/assets/js/imagepreviewprofile.js"></script>
<script>
    // Pemanggilan displayImage dengan URL gambar yang sudah dimiliki
    var profileUrl = <?php echo json_encode(base_url('user_profile/' . $user["FotoProfil"])); ?>;
    window.onload = function() {
        displayImageProfile(profileUrl);
    };
</script>
<?= $this->endSection(); ?>