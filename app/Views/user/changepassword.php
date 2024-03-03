<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/css/imagepreviewprofile.css" />

<?php
$passwordError = session()->getFlashdata('passwordError');
$newpasswordError = session()->getFlashdata('newpasswordError');
$confirmError = session()->getFlashdata('confirmError');
?>

<div class="container">
    <form action="/changepasswordsubmit/<?= $user['UserID'] ?>" method="post" enctype="multipart/form-data">
        <div class="containerPost border-mix melengkung">
            <div class="row">
                <div class="col-12">
                <div class="form-container">
                        
                            <div class="form-group">
                               
                                <label for="title">Password</label>
                                <input type="password" id="password" name="password" autocomplete="off" value="<?= old('password')?>" required>
                                <p style="color: red;"><?= $passwordError ?></p>
                               
                            </div>
                            <div class="form-group mt-3">
                            
                                <label for="title">New Password</label>
                                <input type="password" id="newpassword" name="newpassword" autocomplete="off" value="<?= old('newpassword')?>">
                                <p style="color: red;"><?= $newpasswordError ?></p>
                            </div>
                            <div class="form-group mt-3">
                            
                                <label for="confirm">Confirm New Password</label>
                                <input type="password" id="confirm" name="confirm" autocomplete="off" value="<?= old('confirm')?>">
                                <p style="color: red;"><?= $confirmError ?></p> 

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