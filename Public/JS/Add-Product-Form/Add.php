<!DOCTYPE html>
  <html>

        <head>
              <meta charset="utf-8"/>
              <title>Ajout article</title>
        </head>

        <body>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>Gestion de produits - Administrateur</h1>
                    </div>
                </div>

            <div class="container">
    
            <div class="row">
                <div class="col-md-6">
                <h1>Ajouter un produit</h1>
                </div>
            </div>
    
      
    
            <div class="row">
              
                <div class="col-md-6">
                    <form method="POST" action="http://localhost/easy_food/administrateur/ajouter" role="form" enctype="multipart/form-data">
                
                
                        <div class="form-group">
                              <label for="reference" class="loginFormElement">Reference</label>
                              <input name="reference" class="form-control" id="reference" type="text">
                        </div>
                        
                        <div class="form-group">
                              <label for="designation" class="loginFormElement">Designation</label>
                              <input name="designation" class="form-control" id="designation" type="text">
                        </div>

                        <div class="form-group">
                                <label for="prix" class="loginFormElement">prix</label>
                                <input name="prix" class="form-control" id="prix" type="text">
                        </div>
             
                        <div class="form-group">
                         
                            <label class="control-label">Image du produit</label>
                         
                            <input name="image" class="filestyle" data-icon="false" type="file">
                 
                        </div>
                  
                        <div class="form-group">
                          <label class="loginformelement" for="description">Description du produit</label>
                          <input id="description" name="description" class="form-control input-lg" placeholder="Description" type="text"><div class="container">
                        </div>
                        
                        <div class="form-group">
                        <label for="exampleFormControlSelect2">Catégorie</label>
                        <select name="categorie" multiple class="form-control" id="exampleFormControlSelect2">
                          <option value="1">burger</option>
                          <option value="2">kebab</option>
                          <option value="3">pizza</option>
                        </select>
               </div>
                        <button name="envoyer" type="submit" id="loginSubmit" class="btn btn-success loginFormElement">Ajouter produits</button>
              
            </div>
                    </form>
      
            </div>

    
    

    
    
    

    
    </div>
    
    <!-- /.container -->

  <footer>
    <hr>
      <div class=" container text-left align-bottom">
      <p>Easy Food | © Copyright 2019, All Rights Reserved</p>
      </div>
  </footer></div>


              <div id="push"></div>
  </body>
</html>