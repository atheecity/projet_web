<!DOCTYPE html>
<html>
    <head>
        <title>Configuration</title>
        <link rel='stylesheet' href='<? asset('css/main.css'); ?>' type='text/css' />
    </head>
    <body>
        <div class="center">
            <img src="<? asset('images/webPlane.png') ?>" alt="" />
            <div class="center_text">
                <p id="vues_bd">Configuration base de donnees</p>
                <p class="erreur"></p>
                <div class="form">
                    <?php echo $form->toString(); ?>
                </div>
            </div>
        </div>
    </body>
</html>