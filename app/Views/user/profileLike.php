<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<div class="box">
    <div class="profilefotobar">
        <img draggable="false" class="profilefoto" src="https://i.pinimg.com/564x/bd/94/ce/bd94ce28cf8aefb521bac31d547f6409.jpg">
    </div>
    <div class="profilebar">
        <h5></h5>
        <p class="username">@<?= $user['Username']; ?></p>
        <p class="count">0 photo</p>
    </div>
    <div class="managebar">
        <a class="shareButton">Share</a>
        <a class="editButton">Edit</a>
        <a href="/logout" class="editButton">Logout</a>
    </div>
</div>
<div class="box">
    <div class="garis"></div>
</div>
<div class="box">
    <div class="photobar">
        <a href="/profile/<?= $user['UserID']; ?>" class="no-decoration no-underline photoButtonCreated">Created</a>
        <a href="/profile/<?= $user['UserID']; ?>/liked" class="underline no-decoration photoButtonSaved selected">Like</a>
        <a href="/profile/<?= $user['UserID']; ?>/album" class="no-decoration no-underline photoButtonAlbum">Album</a>
    </div>
</div>

<?= $this->endSection(); ?>