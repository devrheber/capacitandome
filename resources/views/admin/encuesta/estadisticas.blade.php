@extends('layouts.app_admin')

@section('tituloPagina','Datos estadísticos')

@section('styles')
    <style type="text/css">
        .fila-desactivada {
            background-color: #f64e60;
            color: #ffffff;
        }
    </style>
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <h5 class="text-dark font-weight-bold my-1 mr-5"> <i class="fa fa-list mr-1"></i> ESTADÍSTICAS DE ENCUESTA</h5>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="fa fa-home"></i> Inicio</a>
            </div>
        </div>
    </div>
@endsection

@section('contenido')
    <!--begin::Container-->
    <div class="container">
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-body">
                <div class="row">
{{--                    <div class="col-12 col-lg-3">--}}
{{--                        <div class="form-group">--}}
{{--                            <label for="">Curso</label>--}}
{{--                            <select id="curso" class="form-control">--}}
{{--                                <option value="0">SELECCIONAR</option>--}}
{{--                                @foreach($cursos as $curso)--}}
{{--                                    <option value="{{$curso->idcurso}}">{{ $curso->titulo }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="col-12 col-lg-3">
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha Inicio</label>
                            <input type="date" id="fecha_inicio" class="form-control">
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="form-group">
                            <label for="fecha_final">Fecha Final</label>
                            <input type="date" id="fecha_final" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="btn_mostrar">MOSTRAR</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
@endsection

@section('script')
    <script>
        var chart = construirGrafico([]);
        $('#btn_mostrar').click(function() {
            $.ajax({
                type: 'get',
                url: '/admin/encuestas/getEstadisticas',
                data: {
                    from: $('#fecha_inicio').val(),
                    to: $('#fecha_final').val(),
                },
                success: function (response) {
                    chart.destroy();
                    chart = construirGrafico(response.data)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // alert('Ocurrió un error')
                }
            });
        });

        function construirGrafico(data) {
            var ctx = document.getElementById('myChart').getContext('2d');
            var labels = [];
            var datasetData = [];
            var datasetColors = [];

            data.forEach(function(item) {
                labels.push(item.nombre_curso);
                datasetData.push({
                    x: item.nombre_curso,
                    y: item.promedio,
                    registros: item.registros
                });
                datasetColors.push(generarColorAleatorio());
            });

            return new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Promedio',
                            data: datasetData,
                            borderWidth: 1,
                            backgroundColor: datasetColors,
                            hoverBackgroundColor: datasetColors
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function (value) {
                                    return value;
                                }
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    var dataset = context.dataset.data[context.dataIndex];
                                    var promedio = dataset.y;
                                    var registros = dataset.registros;
                                    return 'Promedio: ' + promedio + ' | Encuestas realizadas: ' + registros;
                                }
                            }
                        }
                    }
                }
            });
        }

        function generarColorAleatorio() {
            var letras = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letras[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
@endsection
