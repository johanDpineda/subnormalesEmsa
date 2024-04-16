<div>
    <div class="" wire:ignore.self>
        <div class="row g-4 mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4>{{__('Welcome')}} {{ Auth::user()->name }}</h4>
                    </div>
                </div>
            </div>
            @if($loggedUserRole != 'League Manage')
                <div class="col-md-3">
                    <div class="card my-3 h-100">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between h-100">
                                <div class="content-left">
                                    <div class="d-flex align-items-center my-1">
                                        <h4 class="mb-0 me-2">
                                            @if(empty($caminantesCount))
                                                <h4 class="mb-0 me-2">0</h4>
                                            @else
                                                <h4 class="mb-0 me-2">{{ $caminantesCount }}</h4>
                                            @endif
                                        </h4>
                                    </div>
                                    <span>{{{__('Total walker')}}}</span>
                                </div>

                                    <i class="fa-solid fa-users-gear fa-2xl"></i>

                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-md-3">
                <div class="card my-3 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between h-100">
                            <div class="content-left">
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2">
                                        {{$usertotal}}
                                    </h4>
                                </div>
                                <span>{{{__('Total Users')}}}</span>
                            </div>

                                <i class="fa-solid fa-users fa-2xl"></i>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card my-3 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between h-100">
                            <div class="content-left">
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2"> {{$countZonasSubnormales}}</h4>
                                </div>
                                <span>{{{__('Active subnormal zones')}}}</span>
                            </div>
                            <i class="fa-solid fa-house-circle-check fa-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card my-3 h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between h-100">
                            <div class="content-left">
                                <div class="d-flex align-items-center my-1">
                                    <h4 class="mb-0 me-2"> {{$countZonasSubnormalesfacturas}}</h4>
                                </div>
                                <span>{{{__('subnormal zones with bill code')}}}</span>
                            </div>
                            <i class="fa-solid fa-file-invoice fa-2xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>



        <div class="container">


            <div class="row">

                <div  class="col-md-6">
                    <!-- Primer div -->

                    <div class="content-box">
                        <figure class="highcharts-figure "  wire:ignore>
                            <div id="containerUsuarios" class="chart-container" style="min-width: 310px; height: 400px; margin: 0 auto" wire:loading.remove></div>


                        </figure>
                    </div>


                </div>

                <div  class="col-md-6">
                    <!-- Segundo div -->


                        <div class="content-box">
                            <figure class="highcharts-figure" wire:ignore>
                                <div id="containerzonasmunicipios" class="chart-container" style="min-width: 310px; height: 400px; margin: 0 auto" wire:loading.remove></div>

                            </figure>
                        </div>




                </div>

            </div>

            <div class="row">

                <div  class="col-md-6">
                    <!-- Primer div -->

                    <div class="content-box">
                        <figure class="highcharts-figure "  wire:ignore>
                            <div id="containerzonasubnormal" class="chart-container" style="min-width: 310px; height: 400px; margin: 0 auto" wire:loading.remove></div>


                        </figure>
                    </div>


                </div>

                <div  class="col-md-6">
                    <!-- Segundo div -->


                        <div class="content-box">
                            <figure class="highcharts-figure "  wire:ignore>
                                <div id="containerzonascountdoc" class="chart-container" style="min-width: 310px; height: 400px; margin: 0 auto" wire:loading.remove></div>


                            </figure>

                        </div>




                </div>

            </div>



        </div>



        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('chartDataUpdated', function (chartData) {
                    updateChartUsuarios(chartData);
                });

                // Llama a la función para obtener los datos por defecto
                var containerUsuarios = document.getElementById('containerUsuarios');
                var defaultDataUsuarios = @json($this->getDefaultChartData()); // Cambia esto al método que retorna los datos para la gráfica de usuarios

                // Actualiza la gráfica con los datos por defecto
                updateChartUsuarios(defaultDataUsuarios);
            });

            function updateChartUsuarios(chartData) {
                Highcharts.chart('containerUsuarios', {
                    chart: {
                        backgroundColor: 'transparent',
                        type: 'bar' // Cambia el tipo de gráfica según tus necesidades (bar, pie, etc.)
                    },
                    title: {
                        text: 'Cantidad de Registros por Caminante'
                    },
                    xAxis: {
                        categories: chartData.labels,
                        title: {
                            text: 'Caminantes', // Título del eje X
                            style: {
                                color: '#000' // Color del texto en el eje X (negro)
                            }
                        },
                        labels: {
                            style: {
                                color: '#000' // Color de las etiquetas en el eje X (negro)
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de Registros', // Título del eje Y
                            style: {
                                color: '#000' // Color del texto en el eje Y (negro)
                            }
                        },
                        labels: {
                            style: {
                                color: '#000' // Color de las etiquetas en el eje Y (negro)
                            }
                        }
                    },
                    series: [{
                        name: 'Registros',
                        data: chartData.data
                    }]
                });
            }

        </script>

        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('chartDataUpdatedmunicipios', function (chartDatamunicipios) {
                    updateChartmunicipios(chartDatamunicipios);
                });

                var containerzonasmunicipios = document.getElementById('containerzonasmunicipios');
                var defaultDatamunicipios = @json($this->getDefaultChartDatamunicipios());

                updateChartmunicipios(defaultDatamunicipios);
            });

            function updateChartmunicipios(chartDatamunicipios) {
                Highcharts.chart('containerzonasmunicipios', {
                    chart: {
                        backgroundColor: 'transparent',
                        type: 'pie'
                    },
                    title: {
                        text: 'Registros de zonas subnormales por municipios',
                        style: {
                            color: '#000'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.y}',
                                style: {
                                    color: '#0000',
                                    textOutline: 'none'
                                }
                            }
                        }
                    },
                    series: [{
                        name: 'Total de Registro',
                        data: chartDatamunicipios.data.map(function (point, index) {
                            return {
                                name: chartDatamunicipios.labels[index],
                                y: point,
                                color: chartDatamunicipios.colors[index] // Asignar colores aquí
                            };
                        })
                    }]
                });
            }



        </script>

        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('chartDataUpdatedzonasubnormal', function (chartDatazonasubnormal) {
                    updateChartzonasubnormal(chartDatazonasubnormal);
                });

                // Llama a la función para obtener los datos por defecto
                var containerzonasubnormal = document.getElementById('containerzonasubnormal');
                var defaultDatamunicipios = @json($this->getChartDatazonasubnormal()); // Cambia esto al método que retorna los datos para la gráfica de usuarios

                // Actualiza la gráfica con los datos por defecto
                updateChartzonasubnormal(defaultDatamunicipios);
            });

            function updateChartzonasubnormal(chartDatazonasubnormal) {
                Highcharts.chart('containerzonasubnormal', {
                    chart: {
                        backgroundColor: 'transparent',
                        type: 'bar' // Cambia el tipo de gráfica según tus necesidades (bar, pie, etc.)
                    },
                    title: {
                        text: 'Registros de zonas subnormales'
                    },
                    xAxis: {
                        categories: chartDatazonasubnormal.labels,
                        title: {
                            text: 'Nombre del sector', // Título del eje X
                            style: {
                                color: '#000' // Color del texto en el eje X (negro)
                            }
                        },
                        labels: {
                            style: {
                                color: '#000' // Color de las etiquetas en el eje X (negro)
                            }
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de Registros', // Título del eje Y
                            style: {
                                color: '#000' // Color del texto en el eje Y (negro)
                            }
                        },
                        labels: {
                            style: {
                                color: '#000' // Color de las etiquetas en el eje Y (negro)
                            }
                        }
                    },
                    series: [{
                        name: 'Registros',
                        data: chartDatazonasubnormal.data
                    }]
                });
            }

        </script>

        

        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('chartDataUpdatedzonasubnormalcouncode', function (chartDatazonasubnormalcountdoc) {
                    updateChartzonasubnormalcountcode(chartDatazonasubnormalcountdoc);
                });

                // Llama a la función para obtener los datos por defecto
                var containerzonascountdoc = document.getElementById('containerzonascountdoc');
                var defaultDatazonasubnormalcountcode = @json($this->getChartDatazonasubnormalcountdoc()); // Obtener datos por defecto para la gráfica
                updateChartzonasubnormalcountcode(defaultDatazonasubnormalcountcode); // Actualizar la gráfica con los datos por defecto
            });

            function updateChartzonasubnormalcountcode(chartDatazonasubnormalcountdoc) {
                Highcharts.chart('containerzonascountdoc', {
                    chart: {
                        backgroundColor: 'transparent',
                        type: 'column' // Cambia el tipo de gráfica a barras
                    },
                    title: {
                        text: 'Documentos subidos por sector',
                        style: {
                            color: 'black'
                        }
                    },
                    xAxis: {
                        categories: chartDatazonasubnormalcountdoc.labels, // Categorías para el eje X (sectores)
                        title: {
                            text: 'Sector'
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Cantidad de documentos subidos' // Corregido el texto del eje Y
                        }
                    },
                    series: [{
                        name: 'Acta EMSA', // Nombre de la serie para Acta EMSA
                        data: chartDatazonasubnormalcountdoc.acta_emsa // Datos de cantidad de registros de Acta EMSA por sector
                    }, {
                        name: 'Acta Representante', // Nombre de la serie para Acta de Representante
                        data: chartDatazonasubnormalcountdoc.acta_representante // Datos de cantidad de registros de Acta de Representante por sector
                    }, {
                        name: 'Certificado Alcaldía', // Nombre de la serie para Certificado de Alcaldía
                        data: chartDatazonasubnormalcountdoc.certificado_alcaldia // Datos de cantidad de registros de Certificado de Alcaldía por sector
                    }],
                    colors: ['#7cb5ec', '#434348', '#90ed7d'] // Colores personalizados para las barras
                });
            }
        </script>














    </div>
</div>
