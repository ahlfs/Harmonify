<!DOCTYPE html>
<html>

<head>
  <title>CodeIgniter 4 Form Example</title>
  <link rel="stylesheet" href="/assets/css/styles.css" />
  <link rel="stylesheet" href="/assets/css/stylesProfile.css" />
  <meta charset="UTF-8">
  <meta name="description" content="Free Web tutorials">
  <meta name="keywords" content="HTML, CSS, JavaScript">
  <meta name="author" content="Ahlfss">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<header>
  <nav class="navbar">
    <div class="menu">
      <img draggable="false" class="logo" src="https://cdn1.iconfinder.com/data/icons/logotypes/32/pinterest-512.png">
      <a href="/" class="home">Beranda</a>
      <a class="create">Create</a>
      <input id="one" type="text" class="search-bar" placeholder="Search">
      <button id="two" class="search-bar"></button>
      <div class="icon-container">
        <a href="/profile"><img tabindex="1" draggable="false" class="icon pp" src="https://i.pinimg.com/564x/bd/94/ce/bd94ce28cf8aefb521bac31d547f6409.jpg"></a>

      </div>
    </div>
    <!--------------------------->
    <div class="responsive-search-bar">
      <input type="text">
      <p class="close">❌</p>
    </div>
  </nav>
</header>

<body>
<?= $this->renderSection('content'); ?>
</body>
<script src="assets/js/script.js"></script>

</html>