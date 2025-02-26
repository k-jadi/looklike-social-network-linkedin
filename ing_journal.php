<!-- // Ing Journal + Date du jour *********************************************** -->
    <div class="ente_mobile">
      <h2>Posts</h2>
      <div class="ecrire_post"> 
         <div style="width: 15%;display:flex;justify-content: center;  align-items: center;">
            <img src="membres/avatar/<?PHP echo $user_info['avatar'] ?>" alt="photo de profil" width=47px height=47px style="border-radius:50%">
         </div>
         <div style="display:flex;justify-content: center;align-items: center;width:85%; border: 1px dotted rgba(105, 105, 105, 0.2); border-radius:10px; padding: 5px 10px;" id="creer_post">
               <p style="text-align:left; color:gray;width:100%">Commencer un post</p>
         </div>
      </div>
      <?PHP
         $videosparpage = 10;
         $videostotalreq = $bdd->query('SELECT id FROM posts');
         $videototal = $videostotalreq->rowCount();
         $pagestotales = ceil($videototal/$videosparpage);



         if (isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page']>0){
            $_GET['page'] = intval($_GET['page']);
            $pagecourante = $_GET['page'];
         }else {
            $pagecourante = 1;
         }

         $depart = ($pagecourante-1)*$videosparpage;

      ?>
      <div class="fil_posts">
         <?PHP  
         $annonce_posts = $bdd->query('SELECT * FROM posts ORDER BY date_post DESC LIMIT '.$depart.','.$videosparpage);
         while ($liste_posts = $annonce_posts->fetch()) {
            $post_auteur = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id = ?');
            $post_auteur->execute(array($liste_posts['id_posteur']));
            $auteur = $post_auteur->fetch();
            ?>

            <!-- Affichage des posts -->
            <div class="post_style">
               <!-- Afficher l'auteur du post : image + nom,prenom,ecole + date de publication -->
               <div style="position:relative;display:flex; flex-direction:row; height:55px;border: 1px dotted rgba(105, 105, 105, 0.2); border-radius:10px;"> 
                  <?PHP 
                     if($auteur['id'] == $_SESSION['id']){
                  ?>
                  
                  <div onclick="supprimer_post(<?PHP echo $liste_posts['id']; ?>)" style="cursor:pointer;display:flex;align-items:center;justify-content:center;position: absolute;top:12px;right:10px;width:fit-content;height:25px;padding:0px 5px;background-color:rgba(105, 105, 105, 0.1);border-radius:5px;font-size:0.7rem;"><span>Supprimer</span></div>
                  <?PHP
                     }
                  ?>
                  <div class="essayer" style="display:flex;  align-items:center;  justify-content:center;">
                     <a href="profil.php?id=<?PHP echo $auteur['id'];  ?>" style="text-decoration:none;">
                        <img src="membres/avatar/<?PHP echo $auteur['avatar'] ?>" alt="photo de profil" width=47px height="47px" style="border-radius:50%">
                     </a>
                  </div>
                  <div style="width: 87%;  padding: 5px 0px;  display:flex;  align-items:center;  justify-content:center;">
                     <p  style="width:100%; text-align:left; font-size:0.7rem;color:gray;">
                        <a href="profil.php?id=<?PHP echo $auteur['id'];  ?>" style="text-decoration:none;">
                           Post de 
                           <?PHP
                           $posteur_prenom = $auteur['prenom'];
                           $posteur_nom = $auteur['nom'];
                           $posteur_ecole = $auteur['ecole'];
                           $post_time = $liste_annonces['date_time_offre'];
                           echo $auteur['prenom'].' '.$auteur['nom'].', Ingénieur '.$auteur['ecole']; 
                           ?>
                           <br>
                           Date de puclication :
                           <?PHP
                           echo $liste_posts['date_post'];
                           ?>
                        </a>
                     </p>
                  </div>
               </div>
               <!-- Afficher le texte et image des posts  -->
               <div style="position:relative; width:100%; border: 1px dotted rgba(105, 105, 105, 0.2); border-radius:10px; padding: 5px 10px;">
                  <i id="plus_post_<?PHP echo $liste_posts['id'] ?>" class="fa-solid fa-arrow-down" style="cursor:pointer;position:absolute;top:60px;right:20px;background-color:rgba(105, 105, 105, 0.1);border-radius:50%;padding:5px;font-size:0.8rem;"></i>
                  <p  id="p_post_<?PHP echo $liste_posts['id'] ?>" style="padding:5px;white-space:normal;width:93%;height:70px;overflow:hidden;text-overflow:ellipsis;text-align:left;font-size:0.8rem;margin-top:15px">
                     <?PHP
                        echo $liste_posts['texte_post'];
                     ?>
                  </p>
                  <p  id="p2_post_<?PHP echo $liste_posts['id'] ?>" style="display:none;white-space:normal;padding:5px;width:93%;height:50px;overflow:hidden;text-overflow:ellipsis;text-align:left;font-size:0.9rem;margin-top:15px">
                     <?PHP
                        echo nl2br($liste_posts['texte_post']);
                     ?>
                  </p>
                  <script>
                     let f<?PHP echo $liste_posts['id'] ?> = document.getElementById('plus_post_<?PHP echo $liste_posts['id'] ?>');
                     let g<?PHP echo $liste_posts['id'] ?> = document.getElementById('p_post_<?PHP echo $liste_posts['id'] ?>');
                     let h<?PHP echo $liste_posts['id'] ?> = document.getElementById('p2_post_<?PHP echo $liste_posts['id'] ?>');
                     f<?PHP echo $liste_posts['id'] ?>.addEventListener('click', ()=>{
                        g<?PHP echo $liste_posts['id'] ?>.style.height = 'fit-content';
                        g<?PHP echo $liste_posts['id'] ?>.style.overFlow = 'auto';
                        g<?PHP echo $liste_posts['id'] ?>.innerHTML = h<?PHP echo $liste_posts['id'] ?>.innerHTML;
                        f<?PHP echo $liste_posts['id'] ?>.style.visibility = 'hidden';
                     })
                  </script>
                  <p  style="width:100%; text-align:left;font-size:0.9rem;margin-top:15px">
                     <?PHP 
                        if (!empty($liste_posts['nom_photo'])){ ?>
                           <img src="membres/posts/<?PHP echo $liste_posts['nom_photo']; ?>" width="100%">
                        <?PHP
                        }
                     ?>
                  </p>
               </div>

               <!-- Barre j'aime -->
               <div style="display:flex;align-items:center;justify-content:space-between;position:relative; width:100%; border: 1px dotted rgba(105, 105, 105, 0.2); border-radius:0px; padding: 5px 20px 5px 10px;">
                  <p>
                     <i class="fa-solid fa-thumbs-up" style="font-size:1rem;color:rgba(105, 105, 105, 0.7);"></i> 
                     (<span id="nombre_likes_<?PHP echo $liste_posts['id'] ?>" style="color:rgba(105, 105, 105, 0.7);font-size:1rem;padding:2px;"><?PHP 
                        $total_nombre_likes = $bdd->prepare('SELECT * FROM likes WHERE id_post=? ');
                        $total_nombre_likes->execute(array($liste_posts['id']));
                        $nouveau_nombre_likes = $total_nombre_likes->rowCount();
                        echo $nouveau_nombre_likes;
                     ?></span>)
                  </p>
                  <p id="jaime<?PHP echo $liste_posts['id'] ?>" style="
                  <?PHP
                     $likes = $bdd->prepare('SELECT * FROM likes WHERE id_post = ? AND id_liker = ?');
                     $likes->execute(array($liste_posts['id'], $_SESSION['id']));
                     $nombre_likes = $likes->rowCount();
                     if ($nombre_likes == 0) {
                     echo "color:rgba(46, 135, 187, 0.7);font-size:1rem;cursor:pointer";
                     }else {
                        echo "color:rgba(105, 105, 105, 0.7);font-size:1rem;";
                     } 
                  ?>
                  ">J'aime</p>
               </div>


               <!-- Formulaire d'envoi des commentaires -->
               <div style="border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:10px;margin:0px 0px;padding:5px;">
                  <form id="formulaire<?PHP echo $liste_posts['id'] ?>">
                     <div style="width: 5%;display:inline-block;vertical-align:middle;margin-right:10px;">
                        <p><img src="membres/avatar/<?PHP echo $user_info['avatar'] ?>" alt="photo de profil" width=25px height="25px" style="border-radius:50%;"></p>
                     </div>
                     <div style="width: 68%;display:inline-block;vertical-align:middle;">
                        <textarea name="textarea<?PHP echo $liste_posts['id'] ?>" id="textarea<?PHP echo $liste_posts['id'] ?>" maxlength="300" placeholder="Ajouter un commentaire" rows="1" style="max-height: 140px;;display: block; margin: 0; padding: 8px; box-sizing: border-box; resize: vertical;width: 100%; padding:5px; border: 1px dotted rgba(105, 105, 105, 0.2); border-radius:10px "></textarea>
                     </div>
                     <div  style="width: 17%;display:inline-block;vertical-align:middle;text-align:center;">
                        <input  type="submit" name="comment_button<?PHP echo $liste_posts['id'] ?>" id="comment_button<?PHP echo $liste_posts['id'] ?>" value="Publier" style="visibility:hidden; width: 90%;padding:5px;cursor:pointer;border-radius:5px;border:none;background-color:blue;color:#fff;font-weight:bold;font-size:0.7rem">
                     </div>
                  </form>
               </div>

               <!-- Affichage des commentaires -->
               <div style="border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:15px;margin:0px 0px;padding:5px;">
                  <?PHP
                     $nombre_comments=$bdd->prepare('SELECT * FROM comments WHERE id_post=?');
                     $nombre_comments->execute(array($liste_posts['id']));
                     $resultat_nombre_comments = $nombre_comments->rowCount();
                  ?>
                  <!-- Nombre de commentaires & Bouton +/-   -->
                  <button class="toggle" id="toggle<?PHP echo $liste_posts['id'] ?>">
                     <p style="font-size:0.7rem;text-align:right;color:blue">
                        <span id="nombre_commentaires<?PHP echo $liste_posts['id'] ?>">
                           ( <?PHP echo $resultat_nombre_comments; ?> commentaires )
                        </span>
                         &nbsp <i class="fas fa-plus icon" id="icon<?PHP echo $liste_posts['id'] ?>" ></i>
                     </p>
                  </button>
                  <!-- Liste des commentaires -->
                  <div class="content" id="div_commentaires<?PHP echo $liste_posts['id'] ?>">
                     <?PHP 
                        $afficher_comments = $bdd->prepare('SELECT * FROM comments WHERE id_post=? ORDER BY id DESC');
                        $afficher_comments->execute(array($liste_posts['id']));
                        while($liste_des_commentaires = $afficher_comments->fetch()){
                        $afficher_commentateur = $bdd->prepare('SELECT * FROM coordonnees_membres WHERE id=?');
                        $afficher_commentateur->execute(array($liste_des_commentaires['id_commentateur']));
                        $photo_commentateur = $afficher_commentateur->fetch();
                     ?>
                     
                     <div  style="width: 80%; background-color: rgba(184, 181, 181, 0.1); padding:10px;border: 1px dotted rgba(105, 105, 105, 0.2);margin-bottom:5px;border-radius:10px;position:relative;left:20px;margin-bottom:5px;">
                        
                        <?PHP 
                        if($photo_commentateur['id'] == $_SESSION['id']){
                        ?>
                        
                        <div onclick="demander_confirmation(<?PHP echo $liste_des_commentaires['id'].','.$liste_posts['id']; ?>)" style="cursor:pointer;display:flex;align-items:center;justify-content:center;position: absolute;top:12px;right:10px;width:fit-content;height:25px;padding:0px 5px;background-color:rgba(105, 105, 105, 0.1);border-radius:5px;font-size:0.7rem;">
                           <i class="fa-solid fa-trash"></i>
                        </div>
                        <?PHP
                           }
                        ?>


                        <div style="width: 5%;display:inline-block;vertical-align:top;margin-right:15px;">
                           <p><img src="membres/avatar/<?PHP echo $photo_commentateur['avatar'] ?>" alt="photo de profil" width=25px height="25px" style="border-radius:50%;"></p>
                        </div>
                        <div style="width: 85%;display:inline-block;vertical-align:top;">
                           <p style="font-size: 0.7rem;font-family:Arial, Helvetica, sans-serif;">Par <?PHP echo $photo_commentateur['prenom'].' '.$photo_commentateur['nom']; ?></p>
                        </div>
                        <div style="vertical-align:top; padding-left:25px;">
                           <p style="font-size: 0.7rem;font-family:Arial, Helvetica, sans-serif;"><?PHP echo $liste_des_commentaires['commentaire']; ?></p>
                        </div>
                     </div>   
                     <?PHP 
                        }
                     ?>
                  </div>
               </div>
            </div>
         <?PHP
         }
         ?>
         <div id="pagination">
         <?PHP 
            for($i=1;$i<=$pagestotales;$i++){
               if($i==$pagecourante){
                  echo $i.' ';
               }elseif($i == $pagecourante+1){
                  echo '<a href="index_profil.php?id='.$_SESSION['id'].'&page='.$i.'" class="suivant">'.$i.'</a>';
               }else{
               echo '<a href="index_profil.php?id='.$_SESSION['id'].'&page='.$i.'">'.$i.'</a>';
               }
            }
         ?>
         </div>
         <div id="spinner1" class="spinner" style="background-color: #fff; text-align:center; padding:15px;">
            <img src="imgindex/waiting.gif" width="20px" height="20px">
         </div>
      </div>
   </div>
   <script>
      function supprimer_post(iddupost)
      {
         if ( confirm('Supprimer mon post ?'))
         {
            document.location.href="controls/supprimer_post.php?idpost="+iddupost+"&id=<?PHP echo $_SESSION['id'];  ?>";
         }  
      }
   </script>
   <script>
      function demander_confirmation(idcommentaire,idpost)
      {
      if ( confirm('Supprimer mon commentaire ?'))
      {
         let nouveau_nombre_commentaire = document.getElementById("nombre_commentaires"+idpost);
         let nouveau_liste_commentaire = document.getElementById("div_commentaires"+idpost);
         let xhr_supprimer_commentaire = new XMLHttpRequest();
         xhr_supprimer_commentaire.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200){
            let res = this.response;
            console.log(res);
            nouveau_nombre_commentaire.innerHTML = res.nbr_commentaires;
            nouveau_liste_commentaire.innerHTML = res.div_commentaires;
            nouveau_liste_commentaire.style.height = "fit-content";

         }
         }
      xhr_supprimer_commentaire.open("GET","controls/supprimer_commentaire.php?idcommentaire="+idcommentaire+"&idpost="+idpost+"&id=<?PHP echo $_SESSION['id']; ?>", true);
      xhr_supprimer_commentaire.responseType = "json";
      xhr_supprimer_commentaire.send();


      }  
      }
   </script>
