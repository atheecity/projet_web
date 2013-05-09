<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="{{ twii.asset('css/chatModule/style.css') }}" />
        <title>CHAT</title>
    </head>
    <body>
        <script type="text/javascript">    
            function sendDSL() {
                var scriptElement = document.createElement('script');
                scriptElement.src = "{{ twii.asset('js/chatModule/dsl_script.php') }}";
                document.body.appendChild(scriptElement);
                setTimeout("sendDSL()", 500);
            }
            sendDSL();
            function messages(message) {
                document.getElementById('messaged').innerHTML = message;
            }
            document.onkeypress = function(e) {
                var enterpressed = e ? e.which == 13 : window.event.keyCode == 13;
                if (enterpressed) {
                    document.getElementById('formsage').submit();
                    return false;
                }
            }
        </script>
        <div id="page">
            <div>
                <form method="post" action="">
                    <fieldset>
                    <legend align=top> Messages:</legend>
                    <textarea name="messaged" id="messaged" rows="20" cols="100" readonly>
                    </textarea>
                    </fieldset>
                </form>
            </div>
            <div>
                <form id="formsage" method="post" action="">
                    <fieldset>
                    <label for="pseudo">Pseudo: </label>
                    <input type="text" name="pseudo" id="pseudo" value="{{ twii.setCookie('pseudo') }}">
                    <fieldset id="field2">
                    <legend align=top> Message:</legend>
                    <textarea name="message" id="message"></textarea>
                    </br>
                    <input type="submit" value="Envoyer"/>
                    </fieldset>
                    </fieldset>
                </form>



            </div>
        </div>

    </body>
</html>
