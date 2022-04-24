<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{ asset('/style.css')}}" rel="stylesheet">

    <title>View Characters</title>
    <style>
        #wrapper {
            width: 900px;
            margin: 0 auto;
        }

        #query {
            width: 700px;
        }

        .card {
            width: 200px;
            float: left;
            margin-left: 10px;
            margin-right: 10px;
            margin-bottom: 25px;
        }

        #comics .card {
            height: 650px;
        }

        #characters .card {
            height: 450px;
        }

        .card p {
            font-size: 15px;
            color: #676767;
        }

        .card h5 {
            line-height: 18px;
        }

        .results {
            overflow: auto;
        }

        .pagination li {
            display: inline-block;
            padding: 30px;
            list-style: none;
        }

    </style>
  </head>
  <body>

    <div id="content">
        <h2>Marvel Characters</h2>

        <div id="wrapper">	
            <div id="header">
                <strong>
                    <a href="http://marvel.com">Data provided by Marvel. &copy; {{ date('Y') }} Marvel</a>
                </strong>
            </div>
        </div>

        <div id="characters" class="results">

            @foreach($paginated_results as $char)
                <article class="card">
                    <img src="{{ $char['thumbnail']['path'] }}/portrait_incredible.jpg" alt="{{ $char['name'] }} thumbnail">

                    <footer>
                        <h5>
                            <a href="{{ getCharacterURL($char) }}" class="card-title">{{ $char['name'] }}</a>
                        </h5>
                    </footer>

                </article>
            @endforeach

        </div>
        
        <div class="pagination">   
            {{ $paginated_results->setPath('characters')->render() }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  </body>
</html>
