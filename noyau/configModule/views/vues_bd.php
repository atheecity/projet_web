<!DOCTYPE html>
<html>
    <head>
        <link rel='stylesheet' href='../../../web/css/main.css' type='text/css' />
    </head>
    <body>
        <div class="center">
            <img src="../../../web/images/webPlane.png" />
            <div class="center_text">
                <p id="vues_bd">Configuration base de donnees</p>
                <p class="erreur"><?php if(isset($erreur))echo $erreur; ?></p>
                <div class="form">
                    <?php echo $form->toString(); ?>
                </div>
            </div>
        </div>
    </body>
</html>