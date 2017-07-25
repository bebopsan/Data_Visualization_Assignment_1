<!DOCTYPE html>
<html>
<meta charset="utf-8">
<style> /* set the CSS */

body { font: 12px Arial;}

path { 
    stroke: steelblue;
    stroke-width: 2;
    fill: none;
}
.point {
  fill: steelblue;
  stroke: #000;
}
.axis path,
.axis line {
    fill: none;
    stroke: grey;
    stroke-width: 1;
    shape-rendering: crispEdges;
}

</style>
<head>
  <title>PHP Test</title>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
    <?php echo '<p>Hello World d</p>'; ?> 
    
    <!-- load the d3.js library -->    
    <script src="http://d3js.org/d3.v3.min.js"></script>
    <script src="/data/declaration.js"></script>
    <script src="scripts/require.js"></script>

    <script>
    var i = 12;
    // alert("Hello, world!");
    // alert(i)
    document.write(5);
    document.write(myvar);
    document.write(data[1].Year);
    // Set the dimensions of the canvas / graph
    var margin = {top: 30, right: 20, bottom: 30, left: 50},
        width = 600 - margin.left - margin.right,
        height = 270 - margin.top - margin.bottom;

    // Parse the date / time
    var parseDate = d3.time.format("%d-%b-%y").parse;

    // Set the ranges
    var x = d3.time.scale().range([0, width]);
    var y = d3.scale.linear().range([height, 0]);

    // Define the axes
    var xAxis = d3.svg.axis().scale(x)
        .orient("bottom").ticks(5);

    var yAxis = d3.svg.axis().scale(y)
        .orient("left").ticks(5);

    // Define the line
    var valueline = d3.svg.line()
        .x(function(d) { return x(d.date); })
        .y(function(d) { return y(d.close); });
        
    // Adds the svg canvas
    var svg = d3.select("body")
        .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
        .append("g")
            .attr("transform", 
                  "translate(" + margin.left + "," + margin.top + ")");

    // Get the data
    d3.csv("data/data.csv", function(error, data) {
        data.forEach(function(d) {
            d.date = parseDate(d.date);
            d.close = +d.close;
        });

        // Scale the range of the data
        x.domain(d3.extent(data, function(d) { return d.date; }));
        y.domain([0, d3.max(data, function(d) { return d.close; })]);

        // Add the valueline path.
        svg.append("path")
            .attr("class", "line")
            .attr("d", valueline(data));

        // Add the X Axis
        svg.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height + ")")
            .call(xAxis);

        // Add the Y Axis
        svg.append("g")
            .attr("class", "y axis")
            .call(yAxis);

    });

    var json = JSON.stringify(data);
    //document.write(json);
    // uriContent = "data:application/octet-stream," + encodeURIComponent(json);
    // newWindow = window.open(uriContent, 'neuesDokument');
    </script>

    <div id="tester" style="width:600px;height:250px;"></div>
    <script>
        var x = $.grep(data,function(index, year){
            console.log(year)
            return index === "Year";
        });
        document.write(x);
        // Plotly.newPlot('tester',data);
    </script>
<!--
    <script src="http://dimplejs.org/dist/dimple.v2.3.0.min.js"></script>
    <script>
    var svg2 = dimple.newSvg("#chartContainer", 590, 400);
    d3.json("/data/declaration.json", function(data) {
        var myChart = new dimple.chart(svg, data);
        myChart.setBounds(60, 30, 500, 330)
        myChart.addMeasureAxis("x", "Year");
        myChart.addMeasureAxis("y", "Glob");
        myChart.addSeries(["NHem", "SHem"], dimple.plot.bubble);
        myChart.addLegend(200, 10, 360, 20, "right");
        myChart.draw();
    });
    </script>
    -->
    
   
</body>
</html>