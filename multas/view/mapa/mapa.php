	<?php 
		if (!isset($_SESSION)) { session_start(); }
		if(!isset($_SESSION["user"])){
			header('Location: ./?c=login');
		}
	?>
	<!-- Inicio view/mapa/mapa.php -->
	<div id="botones" class="btn-group btn-group-justified">
			<!-- <a href="#" class="btn btn-primary" onClick="setPosicion(i)">Name</a>
			Aquí se cargan los botones mediante la función createButtons()-->
	</div>
	

	<!-- Contenedor donde se cargará el mapa  class="embed-responsive embed-responsive-16by9"-->
	<div id="map_canvas" style="height:500px;width:100%;">
		<div class="alert alert-info">
		  <strong>Cargando mapa...!</strong> Espere por favor.
		</div>
	</div>

	<!-- API de Google Maps -->
	<script src="http://maps.googleapis.com/maps/api/js"></script>

	<!-- Creación y personalización del mapa -->
	<script type="text/javascript">
			//Se definen variables para las ubicaciones y los objetos del mapa.
			var mapa;
			//El array markers almacena los markers creados con la función newMarker
			var markers = [];
			var infoWindow = new google.maps.InfoWindow();
			//Función para inicializar el mapa cuando se carga la página
			function initialize(){
				var objLatlng = new google.maps.LatLng(3.434175, -76.524766); //Cali
				var myOptions = {
					center: objLatlng,
					zoom: 12,
					mapTypeId: google.maps.MapTypeId.ROADMAP
				};
				
				//Objeto google.maps.Map, se carga en el DIV map_canvas
				mapa = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
				
				
				//Se crean nuevos markers.
				newMarker('Carrera', mapa, 3.472136, -76.503436, 'CC Automotriz Carrera',
                    htmlContenidoInfowindow(
                        'Sede CC. Automotriz Carrera',
                        'Calle 52 # 1B - 160 Centro Comercial Automotriz Carrera',
                        'Santiago de Cali (Norte)',
                        'Valle del Cauca Colombia',
                        'Lunes a Viernes: 7:30 a.m. a 5:00 p.m. (Jornada Continua)',
                        'Sábados: 9:00 a.m. a 12:00 m'
                    )
                );

				newMarker('Aventura Plaza', mapa, 3.368254, -76.530574, 'CC Aventura Plaza',
                    htmlContenidoInfowindow(
                        'Sede CC. Aventura Plaza',
                        'Carrera 100 # 15A - 61 Centro Comercial Aventura Plaza 2do Piso',
                        'Santiago de Cali (Norte)',
                        'Valle del Cauca Colombia',
                        'Lunes a Viernes: 7:30 a.m. a 5:00 p.m. (Jornada Continua)',
                        'Sábados: 9:00 a.m. a 12:00 m'
                    )
                );

				newMarker('Salomia', mapa, 3.466619, -76.497072, 'Salomia',
                    htmlContenidoInfowindow(
                        'Transito Municipal de Salomia Cali',
                        'Cra 3 # 56 - 30',
                        'Santiago de Cali (Norte)',
                        'Valle del Cauca Colombia',
                        'Lunes a Viernes: 7:30 a.m. a 5:00 p.m. (Jornada Continua)',
                        'Sábados: 9:00 a.m. a 12:00 m'
                    )
                );

				newMarker("Sameco", mapa, 3.490846, -76.513039, 'Sede Sameco',
                    htmlContenidoInfowindow(
                        'Sede Sameco',
                        'Carrera 70 Norte # 3BN - 200 Centro de Diagnostico Automotor del Valle',
                        'Santiago de Cali (Norte)',
                        'Valle del Cauca Colombia',
                        'Lunes a Viernes: 7:30 a.m. a 5:00 p.m. (Jornada Continua)',
                        'Sábados: 8:00 a.m. a 12:00 m'
                    )
                );

				//Se crean los botones requeridos según la cantidad de marker creados en el arreglo markers.
				createButtons();
			}
			//Se ejecuta el metodo initialize al cargar la página
			//window.onload = initialize;
			google.maps.event.addDomListener(window, 'load', initialize);
			

			//**** FUNCIONES ****
			//crea un marker y lo almacena en el arreglo markers.
			function newMarker(nombre, mapa, lat, lng, titulo, contenido) {
                //los datos del marker se almacenan en un arreglo asociativo
                var marker = []
                marker["nombre"] = nombre;
                marker["latlng"] = new google.maps.LatLng(lat, lng);
                marker["marker"] = new google.maps.Marker({
                    position: marker["latlng"],
                    map: mapa,
                    title: titulo,
                    //icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
                    draggable: false
                });
                marker["contenido"] = contenido;

                //Se crea un Listener para que al dar clic en un marker, se muestre el infoWindow.
                google.maps.event.addListener(marker["marker"], 'click', function () {
                    infoWindow.setContent(marker["contenido"]);
                    infoWindow.open(mapa, marker["marker"]);
                });
                markers.push(marker);
            }

            function htmlContenidoInfowindow(titulo, dir, ciudad, dpto, horario1, horario2){
                html = '<div id="infoWindow">' +
                        '<h3><img src="assets/img/logo_transito_small.png"> '+titulo+'</h3>'+
                        '<b>Dirección:</b><br>'+
                        dir +'<br>'+
                        ciudad +'<br>'+
                        dpto +'<br>'+
                        '<b>Horario de Atención:</b><br>'+
                        horario1 +'<br>'+
                        horario2 +'<br>'+
                        '</div>';
                return html;
            }
			
			//Al presionar un botón, cambia la posición del mapa.
			function setPosicion(i){
				mapa.panTo(markers[i]["latlng"]);
				mapa.setZoom(13);
				infoWindow.setContent(markers[i]["contenido"]);
				infoWindow.open(mapa, markers[i]["marker"]);
				document.getElementById("latlng").innerHTML = markers[i]["latlng"];
			}
			
			//Crea los botones requeridos según la cantidad de marker creados en el arreglo markers.
			function createButtons(){
				var html="";
				var i=0;
				for(marker in markers){
					html += '<a href="#" class="btn btn-primary" onClick="setPosicion('+i+')">'+markers[i]["nombre"]+'</a>';
					i++;
				}
				document.getElementById("botones").innerHTML = html;
			}

		</script>

	<!-- <div id="latlng"></div> -->

	<!-- Fin view/mapa/mapa.php -->
	