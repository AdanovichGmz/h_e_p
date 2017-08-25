
                                   function createChart() {
                                       $("#graficajs").kendoChart({
                                           title: {
                                               position: "bottom",
                                               text: ""
                                           },
                                           legend: {
                                               visible: false
                                           },
                                           chartArea: {
                                               background: ""
                                           },
                                           seriesDefaults: {
                                               labels: {
                                                   visible: false,
                                                   background: "transparent",
                                                   template: "#= category #: \n #= value#%"
                                               }
                                           },
                                           series: [{
                                               type: "pie",
                                               startAngle: 150,
                                               data: [{
                                                   category: "",
                                                   value: 53.8,
                                                   color: "#00B050"
                                               },{
                                                   category: "",
                                                   value: 16.1,
                                                   color: "#FF2626"
                                               }]
                                           }],
                                           tooltip: {
                                               visible: true,
                                               format: "{0}%"
                                           }
                                           //,
                                           //seriesClick: onSeriesClick
                                       });
                                   }

$(document).ready(createChart);
$(document).bind("kendo:skinChange", createChart);
