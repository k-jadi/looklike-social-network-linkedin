
<div style="border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:10px;position:relative;display:flex;flex-direction:column;justify-content:center;align-items:center;width:100%;height:80vh;overflow:hidden;background-color:#fff;">
    <div style="border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:10px;background-color:#fff;position:absolute;top:0px;height:55px;width:99%;display:flex;padding:5px;margin:5px;">
        <div style="width: 18%;">
            <?PHP echo '<img src="../membres/avatar/'.$photo_affichee_finale['avatar'].'" width="35px height="35px" style="border-radius:50%"">'; ?>
        </div>
        <div  style="width: 81%;display:flex;align-items:center;justify-content:left;padding-left:5px;">
            <?PHP echo $photo_affichee_finale['prenom'].' '.$photo_affichee_finale['nom']; ?>
        </div>
    </div>
    <div style="border: 1px dotted rgba(105, 105, 105, 0.2);border-radius:10px;padding:5px;overflow:hidden;position:absolute;top:65px;width:99%;font-family:Arial, Helvetica, sans-serif;font-weight:bold;" >
        <form action="controls/insertion_profil_message_direct.php?id=<?PHP echo $_SESSION['id']; ?>&id_correspondant=<?PHP echo $get_id; ?>" method="post">
            <div style="width: 100%;display:inline-block;vertical-align:middle;">
                <textarea name="message_direct" id="message_direct" maxlength="500" placeholder="Ecrire un message ..." rows="12" style="margin: 0; box-sizing: border-box; resize: none;width: 100%; padding:5px; border: 1px dotted rgba(105, 105, 105, 0.2); border-radius:5px "></textarea>
            </div>
            <div  style="width: 100%;display:inline-block;vertical-align:middle;text-align:center;">
                <input  type="submit" disabled="true" name="envoi_message_direct" id="envoi_message_direct" value="Envoyer" style="width: 99%;padding:5px;cursor:not-allowed;border-radius:5px;border:none;background-color:rgba(105, 105, 105, 0.3);color:#fff;font-weight:bold;font-size:0.7rem">
            </div>
        </form>
    </div>
    <span class="fenetre_fermeture_message_direct"><i class="fa-solid fa-x" style="font-size: 2rem; color:orangered"></i></span>
    </div>
</div>    
    <script>
        let x = document.getElementById('message_direct');
        let y = document.getElementById('envoi_message_direct');
        x.addEventListener('input', ()=> {
            if (x.value != '') {
                y.style.backgroundColor = 'blue';
                y.style.cursor = 'pointer';
                y.disabled="";
            }
            else {
                y.style.backgroundColor = 'rgba(105, 105, 105, 0.3)';
                y.style.cursor = 'not-allowed';
                y.disabled="true";
            }
        })
    </script>
