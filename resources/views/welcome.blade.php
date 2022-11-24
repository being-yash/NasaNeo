<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NASA Near Earth Objects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="bg-dark">
    <div class="container">
        <div class="row mx-1 my-1">
            <h2 class="text-center alert alert-info mt-2">NASA Near Earth Objects</h2>
        </div> 

        <form method="post" action="{{ url('/getNeos') }}" class="mx-1 form-inline">
            @csrf
            <div class="row alert alert-info mx-1 align-items-start">
                <div class="col-md-6">
                    <h3>Select Start Date :-</h3> <input class="datePicker form-control" type="date" name="startDate" value="{{ $startDate ?? $today }}" required>
                </div>
                <div class="col-md-6">
                    <h3>Select End Date :-</h3> <input class="datePicker form-control" type="date" name="endDate" value="{{ $endDate ?? $today }}" required>
                </div>
                <input type="submit" class="mt-3 col-md-12 btn btn-secondary btn-block" value="Submit">
            </div>   
        </form>
        <div class="row text-center mx-1">
            <div class="col-md-6 alert alert-info">
                @if(isset($neo_count_by_date_arry_values))
                <h3>Number of asteroids for each day</h3>
                <canvas id="myChart" width="400" height="400" style="border: solid;color: darkblue;"></canvas>
                @else
                <h3 class="text-danger">Please Select Date to get data</h3>
                @endif
            </div>
            <div class="col-md-6 alert alert-info">
                @if(isset($neo_count_by_date_arry_values))
                <h3>Asteroid Stat's received from NEO Feed</h3>
                <table class="table table-striped">
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Fastest Asteroid Id & Speed(in KM/Hour)</td>
                      <td>{{ $fastestAseroidId }}</td>
                      <td>{{ $fastestAseroid }}</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Closest Asteroid Id & Distance(in KM)</td>
                        <td>{{ $closestAseroidId }}</td>
                        <td>{{ $closestAseroid }}</td>
                    </tr>
                  </tbody>
                </table>
                @else
                <h3 class="text-danger">Please Select Date to get data</h3>
                @endif
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

    <script>
        var noOfAstroids = <?php  echo json_encode($neo_count_by_date_arry_values ?? ""); ?>;
        var astroidsAppeardate = <?php  echo json_encode($neo_count_by_date_arry_keys ?? ""); ?>;
        
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels:astroidsAppeardate,
                datasets: [
                    {
                        label: 'Number of Asteroids',
                        data: noOfAstroids,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
  </body>
</html>