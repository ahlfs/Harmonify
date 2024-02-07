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
                <div class="form-container">
                        
                            <div class="form-group">
                                <label for="title">Username</label>
                                <input type="text" id="title" name="username" autocomplete="off" value="<?= (old('username')) ? old('username') : $user['Username']; ?>" required>
                                <span><?= $usernameError ?></span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title">Full Name</label>
                                <input type="text" id="title" name="namalengkap" autocomplete="off" value="<?= (old('namalengkap')) ? old('namalengkap') : $user['NamaLengkap']; ?>">
                            </div>
                            <div class="form-group mt-3">
                                <label for="title">Email</label>
                                <input type="text" id="title" name="email" autocomplete="off" value="<?= (old('email')) ? old('email') : $user['Email']; ?>">
                                <span><?= $emailError ?></span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="title">Address</label>
                                <input type="text" id="title" name="alamat" autocomplete="off" value="<?= (old('alamat')) ? old('alamat') : $user['Alamat']; ?>">
                            </div>
                            <div class="form-submit">
                                <button type="submit" name="register" class="submit">Update</button>
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