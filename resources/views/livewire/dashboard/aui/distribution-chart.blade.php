<div x-data="{
  init() {
    Highcharts.chart('cognitive-load-distribution', {
        chart: {
          type: 'pie',
          zooming: {
            type: 'xy'
          },
          panning: {
            enabled: true,
            type: 'xy'
          },
          panKey: 'shift'
        },
        title: {
          text: 'Distribusi Beban Kognitif'
        },
        tooltip: {
          valueSuffix: '%'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: [{
              enabled: true,
              distance: 20
            }, {
              enabled: true,
              distance: -40,
              format: '{point.percentage:.1f}%',
              style: {
                fontSize: '1.2em',
                textOutline: 'none',
                opacity: 0.7
              },
              filter: {
                operator: '>',
                property: 'percentage',
                value: 10
              }
            }]
          }
        },
        series: [
          {
            name: 'Percentage',
            colorByPoint: true,
            data: @js($data)
          }
        ]
      })
  }
}">
  <div id="cognitive-load-distribution">
    {{-- Because she competes with no one, no one can compete with her. --}}
  </div>
</div>

