<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,800,800i,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
   
    
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col mt-4">
                    <div class="jumbotron">
                            <h1 class="display-5">Documents</h1>
                        </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <ul class="p-0 m-0">
            
                    @foreach ($chapters as $row)
                   
                        <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">
                                    {{($row->book['title'])}}</h5>
                            <p class="card-text">{!! str_replace([PHP_EOL],['<br/>'],$row->raw) !!}</p>
                        </div>
                    </div>
                
                @endforeach
            </ul>
            </div>
        </div>
        
       
        
       
    </div>
</body>
</html>