<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Found</title>
</head>

<style>
.container {
    margin: 0 auto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.container img {
    width: 600px;
    height: 600px;
    background-size: cover;
}
</style>

<body>

    <div class="container">
        <img src="{{ url('assets/image/not-found.jpg') }}">
    </div>

</body>

</html>