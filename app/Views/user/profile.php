<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<div class="box">
    <div class="profilefotobar">
        <img draggable="false" class="profilefoto" src="https://i.pinimg.com/564x/bd/94/ce/bd94ce28cf8aefb521bac31d547f6409.jpg">
    </div>
    <div class="profilebar">
        <p class="username">@ahlfss</p>
        <p class="count">0 photo</p>
    </div>
    <div class="managebar">
        <a class="shareButton">Share</a>
        <a class="editButton">Edit</a>
    </div>
</div>
<div class="box">
    <div class="garis"></div>
</div>
<div class="box">
    <div class="photobar">
        <a href="/profile" class="underline no-decoration photoButtonCreated selected">Created</a>
        <a href="/profile/saved" class="no-decoration no-underline photoButtonSaved">Saved</a>
    </div>
</div>

<?= $this->endSection(); ?>