<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD operation</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="body-wrapper">
        <div class="main">
            <h2>File Upload</h2>
            <div class="form">
                <form action="" id="submitForm">
                    <div class="form-control">
                        <label for="name">File</label>
                        <input type="file" name="file" id="file" />
                        <button type="submit" id="upload">
                            <span class="upload-txt">Upload</span>
                            <span class="spinner-border"></span>
                        </button>

                    </div>
                    <div class="form-control">
                        <span id="loading"></span><span id="success"></span>
                    </div>
                    <div id="error" style="color:red"></div>
                    <div id="upload-img">

                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../js/jquery.js"></script>
    <script>
        $('#submitForm').submit(function(e) {
            e.preventDefault();
            if ($('#file').val() == '') {
                $('#error').html("File not select");
                return false;
            }

            var formData = new FormData(this);
            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.spinner-border').css('display', 'inline-block');
                },
                success: function(data) {
                    $('#error').html("");
                    $('#submitForm')[0].reset();
                    $('.spinner-border').css('display', 'none');
                    $('#upload-img').html(data);
                }
            });
        });
        //Delete function
        $(document).on('click', '#deleteFile', function() {
            var file = $('#deleteFile').data('path');
            if (confirm('Do you want to delete.')) {
                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: {
                        file: file
                    },
                    success: function(data) {
                        $('#upload-img').html("");
                    }
                });
            }
        });

    </script>
</body>

</html>
