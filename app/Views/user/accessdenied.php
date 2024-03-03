<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/css/accessdenied.css" />

<div class="containerAccessDenied">
    <h1>Access Denied</h1>
    <p class="textku">Sorry, you don't have permission to access this page.</p>


    <a href="/">
        <div class="homepage"> Go to Home Page</div>
    </a>

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