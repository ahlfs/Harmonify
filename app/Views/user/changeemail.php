<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/css/imagepreviewprofile.css" />

<?php
$emailError = session()->getFlashdata('emailError');
?>

<div class="container">
    <form action="/changeemailsubmit/<?= $user['UserID'] ?>" method="post" enctype="multipart/form-data">
        <div class="containerPost border-mix melengkung">
            <div class="row">
                <div class="col-12">
                    <div class="form-container">

                        <div class="form-group">
                            <label for="title">New Email</label>
                            <input type="email" id="password" name="newemail" autocomplete="off" value="<?= old('newemail') ?>" required>
                            <p style="color: red;"><?= $emailError ?></p>
                        </div>
                        <div class="form-submit">
                            <button type="submit" name="register" class="submit">Change</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
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