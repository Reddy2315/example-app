<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Result page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body class="bg-info-subtle">
    <section class=" container bg-light-subtle p-5 mx-auto my-5">
        <h1>Calcualtor Result</h1>
        <hr>
        <div>Value of A is <span class="text-danger">{{$a}} </span></div>
        <div>Value of B is <span class="text-danger">{{$b}} </span></div>
        <div>Value of Opr is <span class="text-danger">{{$opr}} </span></div>
        <hr>
        <h2 class="pb-4">
            <div>The result is <span class="text-primary">{{$result}} </span></div>

        </h2>
        <a class="btn btn-primary" href="/calculator/form"> back to form</a>

    </section>
</body>

</html>