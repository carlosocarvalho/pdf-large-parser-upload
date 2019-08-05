<!DOCTYPE html>
<html>

<head>
    <title>Laravel 5.6 - File upload with progress bar - ItSolutionStuff.com</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,800,800i,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <style>
        body,
        html {
            padding: 0px;
            height: 100vh;
            font-family: 'Nunito', sans-serif;

        }

        .main,
        .main-container {
            height: 100vh;

        }

        .btn {
            border-radius: 2px !important;
        }
    </style>
</head>

<body>

    <div class="container main">
        <div class="row main-container align-items-center justify-content-center">

            <div class="col-md-4">
                <div class="card">

                    <div class="card-body">
                        <div class="form-group">
                            <h5 class="card-title">
                                Arquivos upload
                            </h5>
                        </div>
                        <form method="POST" action="{{ route('fileUploadPost') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input name="file" id="poster" type="file" class="form-control">
                                <br />
                                <div id="progress-bar-percent" class="progress">
                                    <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>

                            </div>

                            <div class="form-group text-right">
                                <input type="submit" value="Processar" class="btn btn-outline-secondary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="http://malsup.github.com/jquery.form.js"></script>

    <script type="text/javascript">
        function validate(formData, jqForm, options) {
            var form = jqForm[0];
            if (!form.file.value) {
                alert('Arquivo nao encontrado');
                return false;
            }
        }

        (function() {

            var progressBar = $('#progress-bar');
            var percent = $('.percent');
            var status = $('#status');

            $('form').ajaxForm({
                beforeSubmit: validate,
                beforeSend: function() {
                    status.empty();
                    var percentVal = '0%';
                    var posterValue = $('input[name=file]').fieldValue();
                    progressBar.width(percentVal).html(percentVal)
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    progressBar.width(percentVal).html(percentVal)
                    
                },
                success: function() {
                    var percentVal = 'Aguarde, enviando..';
                    //progressBar.width(percentVal).html(percentVal)
                },
                complete: function(xhr) {
                    status.html(xhr.responseText);
                    //alert('Uploaded Successfully');
                    //window.location.href = "/";
                }
            });

        })();
    </script>
</body>

</html>