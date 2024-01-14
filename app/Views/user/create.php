<?= $this->extend('layouts/layoutUser'); ?>
<?= $this->section('content'); ?>



<!-- We'll transform this input into a pond -->
<form action="/upload" method="post" enctype="multipart/form-data">
<?= csrf_field() ?>
<input type="file" class="filepond" name="filepond" multiple data-allow-reorder="true" data-max-file-size="3MB" data-max-files="1">
<input type="text" name="JudulFoto">
<input type="text" name="DeskripsiFoto">
<input type="text" name="Url">
<button type="submit">Submit</button>
</form>




<?= $this->endSection(); ?>