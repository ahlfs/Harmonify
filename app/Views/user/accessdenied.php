<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="/assets/css/accessdenied.css" />

<div class="containerAccessDenied">
    <h1>Access Denied</h1>
    <p>Sorry, you don't have permission to access this page.</p>
    
    
    <a href="/"><div class="homepage"> Go to Home Page</div></a>

</div>

<?= $this->endSection(); ?>