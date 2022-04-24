<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Upload Csv FIle</title>
    <style>
        .content {
            max-width: 500px;
            margin: auto;
            margin-top: 100px;
        }
    </style>
  </head>
  <body>

    <div class="content">
        <form method="POST" enctype="multipart/form-data" action="{{ route('upload') }}">
        @csrf
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload Csv File</label>
                <input class="form-control" type="file" id="csvFile" name="csvFile">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <br>

            @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible">
                    {{ session()->get('message') }}
                </div>
            @endif
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
