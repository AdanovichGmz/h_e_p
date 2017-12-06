var jQuery1102=$.noConflict(true);
function createChart() {
    jQuery1102("#_GraficaInter").kendoChart({
        theme: "metro",
        chartArea: { background: "transparent" },
        title: {
            text: ""
        },
        legend: {
            position: "bottom"
        },
        seriesDefaults: {
            type: "column"
        },
        series: [{
            name: "Disponiblidad",
            data: [75],
            color: "#265CFF"
        }, {
            name: "Calidad",
            data: [25],
            color: "#00BFFF"
        }, {
            name: "Desempeño",
            data: [89],
            color: "#00D900"
        }],
        valueAxis: {
            labels: {
                format: "{0}%"
            },
            line: {
                visible: false
            },
            axisCrossingValue: 0
        },
        categoryAxis: {
            categories: [],
            line: {
                visible: false
            },
            labels: {
                padding: { top: 135 }
            }
        },
        tooltip: {
            visible: true,
            format: "{0}%",
            template: "#= series.name #: #= value #"
        }
    });
}

jQuery1102(document).ready(createChart);
jQuery1102(document).bind("kendo:skinChange", createChart);