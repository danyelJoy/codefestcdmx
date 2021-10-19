$(document).ready(function () {
  $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  $('#registros').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": false,
    "responsive": true,
    'language': {
      paginate: {
          next: 'Siguiente',
          previous: 'Anterior',
          last: 'Último',
          first: 'Primero'
      },
      info: 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
      emptyTable: 'No hay registros',
      infoEmpty: '0 Registros',
      search: 'Buscar: '
  },    
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]      
  }).buttons().container().appendTo('#registros_wrapper .col-md-6:eq(0)');
});

$('#crear_registro_admin').attr('disabled', true);

$('#repetir_password').on('keyup', function(){
  let password_nuevo = $('#password').val(),
      campo_password = $('#password'),
      campo_repetir_password = $('#repetir_password');

      campo_password.removeClass('is-valid is-invalid');
      campo_repetir_password.removeClass('is-valid is-invalid');
      //$('#resultado_password').removeClass('valid-feedback invalid-feedback')

  if($(this).val() == password_nuevo){
    $('#resultado_password').text('Correcto');
    campo_password.addClass('is-valid');
    campo_repetir_password.addClass('is-valid')
    $('#resultado_password').addClass('valid-feedback').removeClass('invalid-feedback');
    $('#crear_registro_admin').attr('disabled', false);
    

  }else {
    $('#resultado_password').text('Password Incorrecto');
    campo_password.addClass('is-invalid');
    campo_repetir_password.addClass('is-invalid')
    $('#resultado_password').addClass('invalid-feedback').removeClass('valid-feedback');

  };
  
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

 
 

  


});



