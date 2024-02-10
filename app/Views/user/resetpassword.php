<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<div class="form-container">
<form action="/changepassword/<?= $user['UserID'] ?>" method="post">
    <div class="form-group mt-3">
        <label for="title">New Password</label>
        <input type="password" id="title" name="password" autocomplete="off">
    </div>
    <div class="form-submit">
        <button type="submit" name="register" class="submit">Change Password</button>
    </div>

</div>

<?= $this->endSection(); ?>