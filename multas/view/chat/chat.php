	<?php 
		if (!isset($_SESSION)) { session_start(); }
		if(!isset($_SESSION["user"])){
			header('Location: ./?c=login');
		}
	?>
    <!-- Inicio view/chat/chat.php -->
    <script type="text/javascript">
        var stream = null;

        window.addEventListener('load', onLoad, false);

        function onLoad(){
            loadMsg(); //Se cargan mensajes almacenados

            if(!hasGetUserMedia() || !hasURL()) {
                errorStream("Navegador no soporta getUserMedia()");
            } else {
                startStream();
            }
        }

        //Funciones para streaming

        function startStream(){
            navigator.getUserMedia(
                {video:true, audio:false},
                setStream,
                errorStream
            );
        }
        function hasGetUserMedia(){//Se valida versión del navegador
            navigator.getUserMedia = navigator.getUserMedia || //Opera
                                    navigator.webkitGetUserMedia || //Opera
                                    navigator.mozGetUserMedia || //Mozilla nightly
                                    navigator.msGetUserMedia; //Safari

            if(navigator.getUserMedia){
                return true;
            }
            return false;
        } //Fin de hasGetUserMedia()

        function hasURL(){ //Se obtiene URL del equipo al cual se le va a hacer streaming
                window.URL = window.URL || window.webkitURL || window.mozURL || window.msURL;
                if(window.URL && window.URL.createObjectURL){
                    return true;
                }
                return false;
        }//Fin de hasURL()

        function errorStream(e){//Validar errores en el stream
            document.getElementById("errorStream").innerHTML += strHtmlError(e);
        }//Fin de error()

        function setStream(s){
            stream = s;
            var webcam = document.getElementById("webcam");
            webcam.src = window.URL.createObjectURL(stream);
            webcam.play();
        }

        function setStateCam(state){
            var webcam = document.getElementById("webcam");
            switch(state){
                case 'play':
                    startStream();
                    $('#btn-play').addClass('disabled');
                    $('#btn-pause').removeClass('disabled');
                    $('#btn-stop').removeClass('disabled');
                    break;
                case 'pause':
                    webcam.pause();
                    $('#btn-play').removeClass('disabled');
                    $('#btn-pause').addClass('disabled');
                    $('#btn-stop').removeClass('disabled');
                    break;
                case 'stop':
                    stream.getVideoTracks()[0].stop();
                    $('#btn-play').removeClass('disabled');
                    $('#btn-pause').addClass('disabled');
                    $('#btn-stop').addClass('disabled');
                    break;
            }
        }


        //Funciones para Chat
        function SaveMsg(){
            document.getElementById("errorMsg").innerHTML = "";
            msg = document.getElementById("msg").value;

            if (msg==""){//Si el mensaje está vació genera error.
                document.getElementById("errorMsg").innerHTML = strHtmlError('Mensaje vacío!');
            } else {
                if (typeof(Storage) !== "undefined") {//Valida que exista Storage (compatibilidad con navegador)
                    date = new Date();

                    html = '<div class="panel panel-primary">' +
                                '<div class="panel-heading">'+ date.toLocaleDateString() + ' ' + date.toLocaleTimeString() +'</div>'+
                                '<div class="panel-body">' + msg + '</div>'+
                            '</div>';

                    if (localStorage.msg == "undefined") //Por si es el primer msg que se guarda...
                        localStorage.msg = html;
                    else  //Sino, entonces adiciona el nuevo mensaje.
                        localStorage.msg = html + localStorage.msg;

                    document.getElementById("historyMsg").innerHTML = localStorage.msg;  //se carga html en el div historyMsg
                } else {
                    document.getElementById("historyMsg").innerHTML = "Sorry, your browser does not support Web Storage...";
                }
                document.getElementById("msg").value = ""  //Limpia textarea
            }
        }

        function loadMsg(){
            if (localStorage.msg != "undefined")
                document.getElementById("historyMsg").innerHTML = localStorage.msg;
            else
                localStorage.msg = "";
        }

        function ClearMsgs(){ //Borra los mensajes almacenados en localStorage
            localStorage.msg = "";
            document.getElementById("errorMsg").innerHTML = "";
            document.getElementById("historyMsg").innerHTML = "";
        }

        //Helpers
        function strHtmlError(text, id=""){//Genera html con formato de error
            htmlErr = '<div class="alert alert-danger" role="alert">' +
                '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true" id="'+id+'"></span>' +
                '<span class="sr-only">Error:</span>' +
                text +
                '</div>';
            return htmlErr;
        }//Fin de error()

    </script>



    <h1 class="page-header">Chat</h1>

    <div class="row">
        <div id="stream" class="col-xs-sm-2 col-md-6" style="background-color:lightgray;">
                <div class="col-sm-1" style="padding-top:10%">
                        <!-- @ReusedBlock("btn-group-vertical hidden-xs") -->
                        <!-- @ReusedBlock("btn-group visible-xs") -->
                        <div class="btn-group-vertical btn-group-xs" role="group" >
                            <a href="#" id="btn-play" class="btn btn-success" onclick="setStateCam('play')">
                                <span class="glyphicon glyphicon-play"></span> Play
                            </a>
                            <a href="#" id="btn-pause" class="btn btn-success" onclick="setStateCam('pause')">
                                <span class="glyphicon glyphicon-pause"></span> Pause
                            </a>
                            <a href="#" id="btn-stop" class="btn btn-success" onclick="setStateCam('stop')">
                                <span class="glyphicon glyphicon-stop"></span> Stop
                            </a>
                        </div>
                </div>
                <div class="col-xs-sm-4 col-md-10">
                    <div class="embed-responsive embed-responsive-4by3">
                            <video id="webcam" class="embed-responsive-item" style=" padding-top: 10px;padding-left: 50px;">Navegador no compatible con HTML5</video>
                    </div>
                </div>
        </div>

        <div class="col-sm-6" >
            <textarea id="msg" class="form-control" rows="4" cols="50" placeholder="Escribe un mensaje aquí." autofocus required ></textarea>
            <div class="text-right">
                <button class="btn btn-success" onclick="SaveMsg()">Enviar Msg</button>
                <button class="btn btn-warning" onclick="ClearMsgs()">Eliminar Msgs</button>
            </div>
            <br>
            <div id="historyMsg" class="pre-scrollable" style="max-height: 200px;width:100%"></div>
        </div>
    </div>
    <div id="errorMsg"></div>
    <div id="errorStream"></div>

    <!--
    @ReusedBlock("btn-group-vertical hidden-xs")
    @ReusedBlock("btn-group visible-xs")

    @helper ReusedBlock(string strClass){
        <div class="@strClass">
            <button class="btn btn-success btn-sm" onclick="stateCam('play')">
                <span class="glyphicon glyphicon-play"></span> Play
            </button>
            <button class="btn btn-success btn-sm" onclick="stateCam('pause')">
                <span class="glyphicon glyphicon-pause"></span> Pause
            </button>
            <button class="btn btn-success btn-sm" onclick="stateCam('stop')">
                <span class="glyphicon glyphicon-stop"></span> Stop
            </button>
        </div>
    } -->