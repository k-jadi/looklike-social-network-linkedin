<?PHP 

   // Début Srcipt php pour les posts pc
   if (isset($_POST['submit_posts'])) {
      if (!empty($_POST['texte_posts'])) 
      {
         if (isset($_FILES['piece_jointe_posts']) AND !empty($_FILES['piece_jointe_posts']['name']))
         {
            $extenionsvalides =  array('jpg','jpeg','gif','png');

               $extenionupload = strtolower(substr(strrchr($_FILES['piece_jointe_posts']['name'],'.'),1));
               if(in_array($extenionupload,$extenionsvalides))
               {
                  $chemin = "membres/posts/".$_FILES['piece_jointe_posts']['name'];
                  $resultat = move_uploaded_file($_FILES['piece_jointe_posts']['tmp_name'],$chemin);
                  if($resultat)
                  {
                     $texte_posts = htmlspecialchars($_POST['texte_posts']);
                     $stock_posts = $bdd->prepare('INSERT INTO posts(id_posteur,texte_post,nom_photo,date_post) VALUES(?,?,?,NOW())');
                     $stock_posts->execute(array($_SESSION['id'],$texte_posts,$_FILES['piece_jointe_posts']['name']));
                     header("Location:index_profil.php?id=".$_SESSION['id']);
                  }   
               }
            
         }
         else
         {
           echo "erreure" ;
         }          

      }
   }
   // Fin script php pour les posts pc

   // Début Srcipt php pour les posts smartphone
   if (isset($_POST['submit_posts2'])) {
      if (!empty($_POST['texte_posts2'])) 
      {
         if (isset($_FILES['piece_jointe_posts2']) AND !empty($_FILES['piece_jointe_posts2']['name']))
         {
            $taillemax2 = 5242880;
            $extenionsvalides2 =  array('jpg','jpeg','gif','png');
            if ($_FILES['piece_jointe_posts2']['size'] <= $taillemax2)
            {
               $extenionupload2 = strtolower(substr(strrchr($_FILES['piece_jointe_posts2']['name'],'.'),1));
               if(in_array($extenionupload2,$extenionsvalides2))
               {
                  $chemin2 = "membres/posts/".$_FILES['piece_jointe_posts2']['name'];
                  $resultat2 = move_uploaded_file($_FILES['piece_jointe_posts2']['tmp_name'],$chemin2);
                  if($resultat2)
                  {
                     $texte_posts2 = htmlspecialchars($_POST['texte_posts2']);
                     $stock_posts2 = $bdd->prepare('INSERT INTO posts(id_posteur,texte_post,nom_photo,date_post) VALUES(?,?,?,NOW())');
                     $stock_posts2->execute(array($_SESSION['id'],$texte_posts2,$_FILES['piece_jointe_posts2']['name']));
                     header("Location:index_profil.php?id=".$_SESSION['id']);
                  }   
               }
            }
         }
         else
         {

         }          

      }
   }
   // Fin script php pour les posts smatphone




?>