/*=========================================================================================
    File Name: chart-chartjs.js
    Description: Chartjs Examples
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(window).on('load', function () {
    'use strict';
    var barChartExample,
    chartWrapper = $('.chartjs'),
      flatPicker = $('.flat-picker'),
      barChartEx = $('.bar-chart-ex');
    // Color Variables
    var successColorShade = '#28dac6',
        tooltipShadow = 'rgba(0, 0, 0, 0.25)',
        labelColor = '#6e6b7b',
        grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

    // Detect Dark Layout
    if ($('html').hasClass('dark-layout')) {
      labelColor = '#b4b7bd';
    }

    // Wrap charts with div of height according to their data-height
    if (chartWrapper.length) {
      chartWrapper.each(function () {
        $(this).wrap($('<div style="height:' + this.getAttribute('data-height') + 'px"></div>'));
      });
    }

    // Init flatpicker
    if (flatPicker.length) {
      var date = new Date();
      flatPicker.each(function () {
        $(this).flatpickr({
          mode: 'range',
          defaultDate: ['2019-05-01', '2019-05-10']
        });
      });
    }

    // Bar Chart
    // --------------------------------------------------------------------
    if (barChartEx.length) {
       barChartExample = new Chart(barChartEx, {
        type: 'bar',
        options: {
          elements: {
            rectangle: {
              borderWidth: 2,
              borderSkipped: 'bottom'
            }
          },
          responsive: true,
          maintainAspectRatio: false,
          responsiveAnimationDuration: 500,
          legend: {
            display: false
          },
          tooltips: {
            // Updated default tooltip UI
            shadowOffsetX: 1,
            shadowOffsetY: 1,
            shadowBlur: 8,
            shadowColor: tooltipShadow,
            backgroundColor: window.colors.solid.white,
            titleFontColor: window.colors.solid.black,
            bodyFontColor: window.colors.solid.black
          },
          scales: {
            xAxes: [
              {
                display: true,
                gridLines: {
                  display: true,
                  color: grid_line_color,
                  zeroLineColor: grid_line_color
                },
                scaleLabel: {
                  display: false
                },
                ticks: {
                  fontColor: labelColor
                }
              }
            ],
            yAxes: [
              {
                display: true,
                gridLines: {
                  color: grid_line_color,
                  zeroLineColor: grid_line_color
                },
                ticks: {
                  stepSize: 50,
                  min: 0,
                  max: 200,
                  fontColor: labelColor
                }
              }
            ]
          }
        },
        data: {
          labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5','Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10','Tháng 11','Tháng 12'],
          datasets: [
            {
              data: [0,0,0,0,0,0,0,0,0,0,0,0],
              barThickness: 25,
              backgroundColor: successColorShade,
              borderColor: 'transparent'
            }
          ]
        }
      });
    }
    loadStatistic(barChartExample);
  });
  function loadStatistic(element) {
    $.ajax({
        type: "GET",
        url: "/admin/api/statistics/get-class-register-month",
        dataType: "json",
        success: function (response) {
            element.data.datasets[0].data = response
            element.update();
        }
      });
  }
