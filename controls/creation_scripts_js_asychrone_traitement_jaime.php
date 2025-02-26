<?PHP  
    $annonce_posts = $bdd->query('SELECT * FROM posts ORDER BY date_post DESC');
    while ($liste_posts = $annonce_posts->fetch()) {
        echo '
        <script>
            document.getElementById("jaime'.$liste_posts['id'].'").addEventListener("click", () => {
                let xhr2'.$liste_posts['id'].' = new XMLHttpRequest();
                xhr2'.$liste_posts['id'].'.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                        document.getElementById("jaime'.$liste_posts['id'].'").style.color = "rgba(105, 105, 105, 0.7)";
                        document.getElementById("jaime'.$liste_posts['id'].'").style.cursor = "text";
                        let res = this.response;
                        let x2 = document.getElementById("nombre_likes_'.$liste_posts['id'].'");
                        x2.innerHTML = res.nbr_likes;
                    }
                    // else { alert(\'oui\');}
                }
                xhr2'.$liste_posts['id'].'.open("GET","controls/insertion_likes.php?id_post='.$liste_posts['id'].'&id_liker='.$_SESSION['id'].'", true);
                xhr2'.$liste_posts['id'].'.responseType = "json";
                xhr2'.$liste_posts['id'].'.send();
                return false;
            }
            );


        </script>
        ';
    }
?>
