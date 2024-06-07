<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="<?= URL ?>login">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if(!Securite::verifAccessSession()) : ?>
        <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>login">Login</a>
      </li>
      <?php else : ?>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>admin">Admin</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Projets
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="<?= URL ?>projets/show">Vue</a>
          <a class="dropdown-item" href="<?= URL ?>projets/create">Création</a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= URL ?>deconnexion">Deconnexion</a>
      </li>
      <?php endif ?>
    </ul>
  </div>
</nav>
