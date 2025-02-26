<?PHP  
    $annonce_posts = $bdd->query('SELECT * FROM posts ORDER BY date_post DESC');
    while ($liste_posts = $annonce_posts->fetch()) {
        echo '
        <script>
            document.getElementById("formulaire'.$liste_posts['id'].'").addEventListener("submit", function(e) {
                e.preventDefault();
                let xhr'.$liste_posts['id'].' = new XMLHttpRequest();
                let data'.$liste_posts['id'].' = new FormData(this);
                xhr'.$liste_posts['id'].'.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200){
                        console.log(this);
                        let res = this.response;
                        let x = document.getElementById("nombre_commentaires'.$liste_posts['id'].'");
                        let y = document.getElementById("div_commentaires'.$liste_posts['id'].'");
                        let z = document.getElementById("icon'.$liste_posts['id'].'");
                        let w = document.getElementById("textarea'.$liste_posts['id'].'");
                        let u = document.getElementById("comment_button'.$liste_posts['id'].'");
                        x.innerHTML = res.nbr_commentaires;
                        y.innerHTML = res.div_commentaires;
                        y.style.height = y.scrollHeight + "px";
                        z.classList.remove(\'fa-plus\');
                        z.classList.add(\'fa-minus\');
                        w.value = "";
                        u.style.visibility = "hidden";
                    }
                    // else { alert(\'oui\');}
                }
                xhr'.$liste_posts['id'].'.open("POST","controls/insertion_commentaires.php", true);
                xhr'.$liste_posts['id'].'.responseType = "json";
                xhr'.$liste_posts['id'].'.send(data'.$liste_posts['id'].');
                return false;
            }
            );


        </script>
        ';
    }
?>
