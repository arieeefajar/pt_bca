<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('vendor/Chart.min.js') }}"></script>
    <title>Tes Canvas</title>
</head>

<body>
    <canvas id="graph" width=500 height="150"></canvas>
    <script>
        let data = @json($dataRegretion);
        let datasets = [];

        data.forEach((value, index) => {
            if (index < 5) {
                const dataset = {
                    label: `Regresi Linier ${value.label}`,
                    data: value.data,
                    backgroundColor: generateRandomColor(),
                    borderWidth: 1
                };

                datasets.push(dataset);
            }
        });

        ctx = document.getElementById('graph');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                datasets: datasets
            }
        })

        function generateRandomColor() {
            var red = Math.floor(Math.random() * 256);
            var green = Math.floor(Math.random() * 256);
            var blue = Math.floor(Math.random() * 256);
            var alpha = 0.2; // Set alpha to 0.2 by default

            var rgbaColor = 'rgba(' + red + ', ' + green + ', ' + blue + ', ' + alpha + ')';

            return rgbaColor;
        }
    </script>
</body>

</html>
