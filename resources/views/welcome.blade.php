<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Secret Santa</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body class="container" style="background: linear-gradient(to right, #411185, #2f0170); /* Adjust the gradient colors */
    color: white; /* Adjust the text color */
    padding: 20px;">
<style>
    /* Style to round the video container */
    .rounded-video-container {
        overflow: hidden;
        border-top-left-radius: 20px; /* Adjust the border-radius value */
        border-top-right-radius: 20px; /* Adjust the border-radius value */
    }

    /* Style to round the video element directly */
    .rounded-video {
        border-top-left-radius: 20px; /* Adjust the border-radius value */
        border-top-right-radius: 20px; /* Adjust the border-radius value */
    }
</style>
<div class="col-12 d-flex justify-content-center shadow-sm  rounded m-3">
    <h1 class="col-6 mt-5 justify-content-center">რევაზ ბელთაძესთვის</h1>
</div>
<div class="col-12 d-flex justify-content-center shadow-sm  rounded  m-3">
    <h1 class="col-6 mt-5 justify-content-center">ვისგან? გამოჩნდება: </h1>

</div>
<div class="col-12 d-flex justify-content-center shadow-sm  rounded  m-3">
    <p class="col-6 mt-5 justify-content-center text-danger" style="font-size: 29px;" id="countdown"></p>

</div>
<div class="col-12 d-flex justify-content-center rounded-video-container">
    <video width="1024" height="720" controls loop class="rounded-video">
        <source src="{{ asset('/imgs/secretsanta.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

<script>
    // Set the target date
    const targetDate = moment('2023-12-29 18:00:00');

    // Update the countdown every second
    function updateCountdown() {
        const currentDate = moment();
        const duration = moment.duration(targetDate.diff(currentDate));

        const days = Math.floor(duration.asDays());
        const hours = duration.hours();
        const minutes = duration.minutes();
        const seconds = duration.seconds();

        // Display the countdown
        document.getElementById('countdown').innerHTML = `${days} days, ${hours} hours, ${minutes} minutes, ${seconds} seconds`;
    }

    // Initial update
    updateCountdown();

    // Update the countdown every second
    setInterval(updateCountdown, 1000);
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Snowstorm/20131208/snowstorm-min.js"></script>

