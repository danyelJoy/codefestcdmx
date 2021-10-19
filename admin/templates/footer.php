<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
  </div>
<!-- ./wrapper -->

<script src="js/sweetalert2.all.min.js"></script>
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="js/demo.js"></script>

<script src="js/admin-ajax.js"></script>
<!--Datatables-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/responsive.bootstrap4.min.js"></script>
<script src="js/dataTables.buttons.min.js"></script>
<script src="js/buttons.bootstrap4.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/vfs_fonts.js"></script>
<script src="js/buttons.html5.min.js"></script>
<script src="js/buttons.print.min.js"></script>
<script src="js/buttons.colVis.min.js"></script>
<script src="js/app.js"></script>
<script src="js/appis.js"></script>
<script src="js/login-ajax.js"></script>
<!-- date-range-picker -->
<script src="js/daterangepicker.js"></script>



<!-- Select2 -->
<script src="js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="js/moment.min.js"></script>
<script src="js/pdfmake.min.js"></script>
<script src="js/jquery.inputmask.min.js"></script>
<script src="js/bootstrap-colorpicker.min.js"></script>
<!-- ChartJS -->
<script src="js/Chart.min.js"></script>
<script src="js/Chart.js"></script>
<script src="js/Chart.bundle.min.js"></script>
<script src="js/Chart.min.js"></script>
<!--FontawesomeIconPicker-->

<script src="js/fontawesome-iconpicker.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/0941b21088.js" crossorigin="anonymous"></script>
<script src="js/all.js"></script>
<script src="js/all.min.js"></script>
<script src="js/bs-custom-file-input.min.js"></script>

<!--Cotizador boletos-->
<script src="../js/cotizador.js"></script>


<script >
   $.getJSON('servicio-registrados.php', function(data){
      console.log(data);
      var fecha_registro =[];
      var cantidad_registro=[];

      for(var i=0; i< data.length; i++){
        fecha_registro[i] = data[i].fecha;
        cantidad_registro[i] = data[i].cantidad;
      }
      console.log(fecha_registro);
      console.log(cantidad_registro);

      var areaChartData = {
        labels : fecha_registro, 
        datasets: [
          {
            label               : 'Registrados',
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : true,
            pointColor          : '#FFFFFF',
            pointStrokeColor    : '#FFFFFF',
            pointRadius         : '3',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: '#FFFFFF',
            data                : cantidad_registro
          }
        ]
      }
      var areaChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        legend: {
          display: true
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false,
            }
          }],
          yAxes: [{
            gridLines: {
              display: true,
            }
          }]
        }
      }
            //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    /*lineChartData.datasets[1].fill = false;*/
    lineChartOptions.datasetFill = false

    let lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    });

    });

 
 
</script>


</body>
</html>
