            <div class="row">
                <div class="col-xs-12">
                    <hr />
                    <footer class="text-center well">
                        <p>UNIAJC - Sistemas de Información</p>
                    </footer>                
                </div>    
            </div>
        </div>

        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery-ui/jquery-ui.min.js"></script>
        <script src="assets/js/ini.js"></script>
        <script src="assets/js/jquery.anexsoft-validator.js"></script>
    </body>
</html>

<?php
    if(isset($_SESSION["user"])){
      echo '<script> $("#login").addClass("hide"); </script>';
    }
?>