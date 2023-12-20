function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var e = document.getElementById(e).getAttribute("data-colors");
        return (e = JSON.parse(e)).map(function (e) {
            var t = e.replace(" ", "");
            if (-1 === t.indexOf(",")) {
                var r = getComputedStyle(
                    document.documentElement
                ).getPropertyValue(t);
                return r || t;
            }
            e = e.split(",");
            return 2 != e.length
                ? t
                : "rgba(" +
                      getComputedStyle(
                          document.documentElement
                      ).getPropertyValue(e[0]) +
                      "," +
                      e[1] +
                      ")";
        });
    }
}
var chartPieBasicColors = getChartColorsArray("simple_pie_chart"),
    options = {
        series: [44, 55, 13, 43, 22],
        chart: { height: 500, type: "pie" },
        labels: ["Team A", "Team B", "Team C", "Team D", "Team E"],
        legend: { position: "right" },
        dataLabels: { dropShadow: { enabled: !1 } },
        colors: chartPieBasicColors,
    },
    chart = new ApexCharts(
        document.querySelector("#simple_pie_chart"),
        options
    );
chart.render();
