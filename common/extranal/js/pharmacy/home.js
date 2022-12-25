"use strict";
google.charts.load('current', {'packages': ['corechart']});
google.charts.setOnLoadCallback(drawVisualization);

function drawVisualization() {
    "use strict";
    var data = google.visualization.arrayToDataTable([
        ['Month', 'Income', 'Expense'],
        ['Jan', this_year['january'], this_year_expenses['january']],
        ['Feb', this_year['february'], this_year_expenses['february']],
        ['Mar', this_year['march'], this_year_expenses['march']],
        ['Apr', this_year['april'], this_year_expenses['april']],
        ['May', this_year['may'], this_year_expenses['may']],
        ['June', this_year['june'], this_year_expenses['june']],
        ['July', this_year['july'], this_year_expenses['july']],
        ['Aug', this_year['august'], this_year_expenses['august']],
        ['Sep', this_year['september'], this_year_expenses['september']],
        ['Oct', this_year['october'], this_year_expenses['october']],
        ['Nov', this_year['november'], this_year_expenses['november']],
        ['Dec', this_year['december'], this_year_expenses['december']]
    ]);

    var options = {
        title: new Date().getFullYear() + per_month_income_expense,
        vAxis: {title: currency},
        hAxis: {title: months_lang},
        seriesType: 'bars',
        series: {5: {type: 'line'}}
    };

    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}

