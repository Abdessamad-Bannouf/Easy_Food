<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Easy_food, la facilité au quotidien</title>

    <link href="Public/Home-Package/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="Public/Home-Package/css/heroic-features.css" rel="stylesheet">
    <link href="../Public/Home-Package/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../Public/Home-Package/css/heroic-features.css" rel="stylesheet">
  </head>

  <body>
    <!-- REQUIRE LA BARRE DE MENU!-->

    <?php require'Public/Header/Header.php'; ?>

    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">Easy Food</h1>
          <div class="list-group">
            <a href="http://localhost/easy_food/produits/burger" class="list-group-item">Burger</a>
            <a href="http://localhost/easy_food/produits/kebab" class="list-group-item">Kebab</a>
            <a href="http://localhost/easy_food/produits/pizza" class="list-group-item">Pizza</a>
          </div>

        </div>

        <div class="col-lg-9">

          <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
              <div class="carousel-item active">
                <img class="d-block img-fluid" src="Public/Images/burger_slide.jpg" alt=" ">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="Public/Images/kebab_slide.jpg" alt=" ">
              </div>
              <div class="carousel-item">
                <img class="d-block img-fluid" src="Public/Images/pizza_slide.jpg" alt=" ">
              </div>
            </div>

            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>

          <div class="row">
            <?php foreach($data['produits'] as $cle=>$produit){?>
            <div class="col-lg-4 col-md-6 mb-4">
              
              <div class="card h-100">
                <?php echo '<img class="card-img-top" src="Public/Images/'.$produit['image'].'" alt=" ">'; ?>
                <?php echo '<img class="card-img-top" src="../Public/Images/'.$produit['image'].'" alt=" ">'; ?>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#"><?= $produit['id']; ?></a>
                  </h4>
                  <h5><?= $produit['prix'].' €' ?></h5>
                  <p class="card-text"><?= $produit['description'] ?></p>
                </div>
                <div class="card-footer">
                  <?php echo'<a href="http://localhost/easy_food/panier/'.$produit['id'].'" class="btn btn-primary">Acheter!</a>'; ?>
                </div>
              </div>
            </div>
            <?php } ?>
          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
    <?php require 'Public/Footer/Footer.php'; ?>
   

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>

</html>

