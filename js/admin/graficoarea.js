CarregarGrafico(elements);
function CarregarGrafico(elements) {
    isJson(elements) ? elements = JSON.parse(elements) : "";
    for(let i =0;i<11;i++){
        elements[i] === undefined ? "" : elements[i] = parseFloat(elements[i]);
    }

    google.charts.load('current', {'packages':['line']});

    google.charts.setOnLoadCallback(function(){drawChart(elements)});

}

function isJson(elements){
    try {
        JSON.parse(elements);
    }catch (erro){
        return false;
    }
    return true;
}

function drawChart(elements){

    var data = new google.visualization.DataTable();

    data.addColumn('string', '');
    data.addColumn('number', '');


    data.addRows([
        ['janeiro',elements[0]],
        ['fevereiro',elements[1]],
        ['marco',elements[2]],
        ['abril',elements[3]],
        ['maio',elements[4]],
        ['junho',elements[5]],
        ['julho',elements[6]],
        ['agosto',elements[7]],
        ['setembro',elements[8]],
        ['outubro',elements[9]],
        ['novembro',elements[10]],
        ['dezembro',elements[11]]

    ]);

    var options = {


        legend: {
            position: 'none'
        },

        colors: ['#ffffff'],

        chartArea: {
            backgroundColor: {
                fill: '#262626',
                fillOpacity: 0.1
            },
        },
        backgroundColor: {
            fill: '#262626',
            fillOpacity: 0.1
        },
    };

    var chart = new google.charts.Line(document.getElementById('linechart_material'));

    chart.draw(data, google.charts.Line.convertOptions(options));
}

//recarregar gráfico ao ajustar o tamanho da página.(responsividade)
window.onresize = RecarregarGrafico;

function RecarregarGrafico() {
    CarregarGrafico(elements);
}
