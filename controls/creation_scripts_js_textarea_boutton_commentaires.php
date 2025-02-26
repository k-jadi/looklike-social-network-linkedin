<?PHP  
    $annonce_posts = $bdd->query('SELECT * FROM posts ORDER BY date_post DESC');
    while ($liste_posts = $annonce_posts->fetch()) {
        echo '
        <script>
        function resizeTextArea'.$liste_posts['id'].'(item) {
            let { style, value } = item;
            style.height = style.minHeight = \'auto\';
            style.minHeight = `${ Math.min(item.scrollHeight + 4, parseInt(item.style.maxHeight)) }px`;
            style.height = `${ item.scrollHeight + 4 }px`;
        }
        const textarea'.$liste_posts['id'].' = document.getElementById(\'textarea'.$liste_posts['id'].'\');
        textarea'.$liste_posts['id'].'.addEventListener(\'input\', () => {
        resizeTextArea'.$liste_posts['id'].'(textarea'.$liste_posts['id'].');
        let textarea_able'.$liste_posts['id'].' = document.getElementById("textarea'.$liste_posts['id'].'").value;
        if (textarea_able'.$liste_posts['id'].' !== \'\'){
            document.getElementById("comment_button'.$liste_posts['id'].'").style.visibility = "visible";         
        }
        else{
            document.getElementById("comment_button'.$liste_posts['id'].'").style.visibility = "hidden";
        }
        })
        </script>
        ';
    }
?>
