<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/css/imagepreviewprofile.css" />

<?php

$usernameError = session()->getFlashdata('usernameError');
$emailError = session()->getFlashdata('emailError');
$fotoprofileError = session()->getFlashdata('fotoprofileError');
?>

<div class="container">
    <form action="/updateprofile/<?= $user['UserID'] ?>" method="post" enctype="multipart/form-data">
        <div class="containerPost border-mix melengkung">
            <div class="row">
                <div class="col-12">
                    <div class="fotoprofile d-flex justify-content-center">
                        <label for="foto" id="drop-area-profile">
                            <input type="file" accept="image/*" id="foto" name="fotoprofile" hidden />
                            <div id="img-view-profile">
                                <div id="img-preview-profile"></div>
                            </div>
                        </label>
                        <span><?= $fotoprofileError ?></span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-detail">
                        <div class="form-row">
                            <span><?= $usernameError ?></span>
                            <input autocomplete="off" type="text" name="username" class="input-text" placeholder="Username" value="<?= (old('username')) ? old('username') : $user['Username']; ?>" required>
                        </div>
                        <div class="form-row">
                            <input autocomplete="off" type="text" name="namalengkap" class="input-text" placeholder="Nama Lengkap" value="<?= (old('namalengkap')) ? old('namalengkap') : $user['NamaLengkap']; ?>">
                        </div>
                        <div class="form-row">
                            <span><?= $emailError ?></span>
                            <input autocomplete="off" type="text" name="email" class="input-text" placeholder="Email Address" value="<?= (old('email')) ? old('email') : $user['Email']; ?>">
                        </div>
                        <div class="form-row">
                            <input autocomplete="off" type="text" name="alamat" class="input-text" placeholder="Address" value="<?= (old('alamat')) ? old('alamat') : $user['Alamat']; ?>">
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