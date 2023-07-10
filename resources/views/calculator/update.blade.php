<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator Update Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body class="bg-info-subtle">
    <section class=" container bg-light-subtle p-5 mx-auto my-5">
        <h1 style="color:blue;">Calcualtor Update Form</h1>

        <form action="/calculator/savedata/{{$data->id}}" method="post">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Enter A</label>
                <input type="text" class="form-control" name="a" id="formGroupExampleInput" value="{{$data->a}}">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Enter B</label>
                <input type="text" class="form-control" name="b" id="formGroupExampleInput2" value="{{$data->b}}">
            </div>

            <div class="mb-3">
                <label for="inputState" class="form-label">Operation</label>
                <select id="inputState" name="opr" class="form-select">
                    <option value="add" @if($data->opr=='add') selected @endif>Addition</option>
                    <option value="sub" @if($data->opr=='sub') selected @endif>Subtraction</option>
                    <option value="mul" @if($data->opr=='mul') selected @endif>Multiplication</option>
                    <option value="div" @if($data->opr=='div') selected @endif>Division</option>
                </select>
                
              <!--  <input type="hidden" name="_token" value="{{ csrf_token() }}"/>--><!-- larval it self create token-->
            @csrf
            </div>

            <div>
                <button type="submit" class="btn btn-success">Save</button>

                <button  class="float-right btn btn-success "><a href="/calculator/logs" style="color:white; text-decoration: none;">Logs</a></button>
            </div>

        </form>
    </section>
</body>

</html>