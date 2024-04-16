Highcharts.chart('container', {
    chart: {
      backgroundColor: '#FCFFC5',
      type: 'column',
      
    },
    title: {
      text: 'Estadísticas generales del Equipo',
      style: {
      
        color: 'white'
      }
      
    },
    subtitle: {
      text: '<a href="https://worldpopulationreview.com/world-cities" target="_blank">Liga Dago</a>',
      style: {
       
        color: 'white'
      }
    },
    xAxis: {
      type: 'category',
      labels: {
        rotation: -45,
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif',
          color: 'white'
        }
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: 'Goles generales del torneo',
        style: {
          
          color: 'white'
        }
      }
    },
    legend: {
      enabled: false
    },
    tooltip: {
      pointFormat: 'Goles dentro del torneo: <b>{point.y:.1f} Liga Dago</b>',
      Fill: '#FFFFFF',
      
    },
    series: [{
      name: 'Goles dentro del torneo',
      colors: [
        '#0bfdf2'
      ],
      colorByPoint: true,
      groupPadding: 0,
      data: [
        
        ['Tokyo', 37.33],
        ['Delhi', 31.18],
        ['Shanghai', 27.79],
        ['Sao Paulo', 22.23],
        ['Mexico City', 21.91],
        ['Dhaka', 21.74],
        ['Cairo', 21.32],
        ['Beijing', 20.89],
        ['Mumbai', 20.67],
        ['Osaka', 19.11],
        ['Karachi', 16.45],
        ['Chongqing', 16.38],
        ['Istanbul', 15.41],
        ['Buenos Aires', 15.25],
        ['johan', 14.974],
        ['Kinshasa', 14.970],
        ['Lagos', 14.86],
        ['Manila', 14.16],
        ['Tianjin', 13.79],
        ['Guangzhou', 13.64],
       
      ],
      dataLabels: {
        enabled: true,
        rotation: -90,
        color: '#FFFFFF',
        stroke: 'rgb(255, 255, 255)',
        align: 'right',
        format: '{point.y:.1f}', // one decimal
        y: 10, // 10 pixels down from the top
        style: {
          fontSize: '13px',
          fontFamily: 'Verdana, sans-serif'
        }
      }
    }]
  });