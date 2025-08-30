<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2019 <a href="https://edosucre.gov.ve" target="_blank">Gobernación del estado Sucre</a>.</strong> Todos los derechos reservados.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="display: none;">
    <!-- Create the tabs -->

    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">

        <!-- /.control-sidebar-menu -->

      </div>


    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?= $_SESSION['base_url1'].'bower_components/jquery/dist/jquery.min.js' ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= $_SESSION['base_url1'].'bower_components/jquery-ui/jquery-ui.min.js' ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= $_SESSION['base_url1'].'bower_components/bootstrap/dist/js/bootstrap.min.js' ?>"></script>
<!-- Morris.js charts -->
<!-- Sparkline -->
<script src="<?= $_SESSION['base_url1'].'bower_components/jquery-sparkline/dist/jquery.sparkline.min.js' ?>"></script>
<!-- jvectormap -->
<script src="<?= $_SESSION['base_url1'].'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' ?>"></script>
<script src="<?= $_SESSION['base_url1'].'plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?= $_SESSION['base_url1'].'bower_components/jquery-knob/dist/jquery.knob.min.js' ?>"></script>
<!-- daterangepicker -->
<script src="<?= $_SESSION['base_url1'].'bower_components/moment/min/moment.min.js' ?>"></script>
<script src="<?= $_SESSION['base_url1'].'bower_components/bootstrap-daterangepicker/daterangepicker.js' ?>"></script>
<!-- datepicker -->
<script src="<?= $_SESSION['base_url1'].'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js' ?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?= $_SESSION['base_url1'].'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js' ?>"></script>
<!-- Slimscroll -->
<script src="<?= $_SESSION['base_url1'].'bower_components/jquery-slimscroll/jquery.slimscroll.min.js' ?>"></script>
<!-- FastClick -->
<script src="<?= $_SESSION['base_url1'].'bower_components/fastclick/lib/fastclick.js' ?>"></script>
<!-- AdminLTE App -->
<script src="<?= $_SESSION['base_url1'].'dist/js/adminlte.min.js' ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="<?= $_SESSION['base_url1'].'dist/js/demo.js' ?>"></script>
<script src="<?= $_SESSION['base_url1'].'dist/js/toastr.js'?>"></script>

<script src="<?= $_SESSION['base_url1'].'bower_components/datatables.net/js/jquery.dataTables.min.js' ?>"></script>
<script src="<?= $_SESSION['base_url1'].'bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js' ?>"></script>
</body>
</html>

<script>
    $(function(){
        $('[data-tool="tooltip"]').tooltip()

        let type = "<?= isset($_SESSION['flash']) ? $_SESSION['flash'] : null ?>";

        if(type)
        {
            switch(type)
            {
                case '1':
                    toastr.success('Operación realizada con éxito','Éxito!')
                break;

                case '2':
                    toastr.error('Ha ocurrido un error al ejecutar la operación','Error!')
                break;
                 
                case '3':
                    toastr.error('El archivo no es una imagen','Error!')
                break;
                 case '4':
                    toastr.error('el tamaño máximo permitido es un 1MB','Error!')
                break;
              case '5':
                    toastr.error('La unidad ya se encuentra asignada a otro conductor','Error!')
                break;
              case '6':
                    toastr.error('No puede eliminar este afiliado porque tiene unidades registradas','Error!')
                break;
              case '7':
                    toastr.error('No se puede eliminar esta E/S porque posee vehículos registrados','Error!')
                break;
              case '8':
                    toastr.error('Rellene todos los campos','Error!')
                break;
              case '9':
                    toastr.success('Usuario reestablecido','Éxito!')
                break;
            }

            <? unset($_SESSION['flash']); ?>
        }

        $('.remover_helper').click(function(){
            let agree = confirm('¿Está seguro de querer eliminar este registro?')

            if(!agree)
            {
                return false
          }
              window.location.replace('./index.php')        
        })        

        $('.reset_helper').click(function(){
            let agree = confirm('¿Está seguro de desea resetear la clave?')

            if(!agree)
            {
                return false
          }
              window.location.replace('./index.php')        
        })        
    });
        
function valida(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8 || tecla==9 || tecla==0){
        return true;
    }    

        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function valida1(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8 || tecla==100 || tecla==9 || tecla==0){
        return true;
    }    

        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}   

  $(function () {
    $('#data-table').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>  
   <? include_once $_SESSION['base_url'].'partials/modal_change_password.php'; ?>
