<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD operation</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="body-wrapper">
        <div class="main">
            <h2>CRUD Operation</h2>
            <div class="form">
                <form action="" id="submitForm">
                    <div class="form-control">
                        <label for="name">Name</label><span id="nameError"></span>
                        <input type="text" name="name" id="name" />
                    </div>
                    <div class="form-control">
                        <label for="city">City</label><span id="cityError"></span>
                        <input type="text" name="city" id="city" />
                    </div>
                    <div class="form-control">
                        <label for="course">Course</label><span id="courseError"></span>
                        <select name="course" id="course">
                            <option value="">Select</option>
                            <option value="BCA">BCA</option>
                            <option value="BBA">BBA</option>
                            <option value="MCA">MCA</option>
                            <option value="MBA">MBA</option>
                        </select>
                    </div>
                    <div class="form-control">
                        <input type="submit" name="submit" id="submit" />
                        <span id="loading"></span><span id="success"></span>
                    </div>
                </form>
            </div>
            <div class="model">
                <div class="form">
                    <h1 class="model-heading">Update data<span id="modelClose">X</span></h1>
                    <form action="" id="updateForm">
                        <div class="form-control">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="updateName" />
                            <input type="hidden" id="updateId" />
                        </div>
                        <div class="form-control">
                            <label for="city">City</label>
                            <input type="text" name="city" id="updateCity" />
                        </div>
                        <div class="form-control">
                            <label for="course">Course</label>
                            <select name="course" id="updateCourse">
                                <option value="">Select</option>
                                <option value="BCA">BCA</option>
                                <option value="BBA">BBA</option>
                                <option value="MCA">MCA</option>
                                <option value="MBA">MBA</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <input type="submit" name="submit" id="submit" value="Update" />
                            <span id="loading"></span><span id="success"></span>
                        </div>
                    </form>
                </div>
            </div>
            <div id="tableData">
                <table>
                    <thead>
                        <th>id</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Course</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script>
        $('#submitForm').submit((e) => {
            e.preventDefault();
            let name = $('#name').val();
            let city = $('#city').val();
            let course = $('#course').val();
            if (name == "") {
                $('#name').css('border-color', 'red');
                $('#nameError').html('Fill the name field');
                return false;
            } else {
                $('#name').css('border-color', '#333');
                $('#nameError').html('');
            }
            if (city == "") {
                $('#city').css('border-color', 'red');
                $('#cityError').html('Fill the City field');
                return false;
            } else {
                $('#city').css('border-color', '#333');
                $('#cityError').html('');
            }
            if (course == "") {
                $('#course').css('border-color', 'red');
                $('#courseError').html('Select the course field');
                return false;
            } else {
                $('#course').css('border-color', '#333');
                $('#courseError').html('');
            }
            $.ajax({
                url: 'action.php',
                type: 'post',
                data: {
                    name: name,
                    city: city,
                    course: course
                },
                beforeSend: function() {
                    $('#loading').html("Loading...")
                },
                success: function(data) {
                    $('#loading').html("");
                    $('#success').html(data);
                    $('#submitForm')[0].reset();
                    ReadData();
                    var msg = setInterval(function() {
                        $('#success').html("");
                        clearInterval(msg);
                    }, 5000);

                }
            })
        });
        //   Read function
        function ReadData() {
            $.ajax({
                url: 'action.php',
                type: 'get',
                data: {
                    read: true,
                },
                dataType: 'JSON',
                success: function(data) {
                    $('#tableData tbody').html("");
                    if (data == "") {
                        $('table thead').css('display', 'none');
                    } else {
                        $('table thead').css('display', 'table-header-group');
                    }

                    console.log(data);
                    $.each(data, function(key, value) {
                        let jsonData = `<tr><td data-label="ID">${key+1}</td><td data-label="Name">${value.name}</td><td data-label="City">${value.city}</td><td data-label="Course">${value.course}</td><td data-label="Edit"><span class="editBtn" onclick="editData(${value.id})">Edit</span></td><td data-label="Delete"><span class="deleteBtn" onclick="deleteData(${value.id})">delete</span></td></tr>`;
                        $('#tableData tbody').append(jsonData);
                    })
                }
            })
        }
        ReadData();

        //edit function
        function editData(value) {
            $.ajax({
                url: 'action.php',
                type: "post",
                data: {
                    editId: value
                },
                dataType: 'JSON',
                success: function(data) {
                    $('body').addClass('model-open');
                    $("#updateName").val(data.name);
                    $("#updateCity").val(data.city);
                    $("#updateCourse").val(data.course);
                    $("#updateId").val(data.id);
                }
            });
        }
        //Update data
        $('#updateForm').submit((e) => {
            e.preventDefault();
            let name = $('#updateName').val();
            let city = $('#updateCity').val();
            let course = $('#updateCourse').val();
            let updateId = $('#updateId').val();
            console.log({
                updateId: updateId,
                updateName: name,
                updateCity: city,
                updateCourse: course
            });
            if (name == "") {
                $('#updateName').css('border-color', 'red');
                return false;
            }
            if (city == "") {
                $('#updateCity').css('border-color', 'red');
                return false;
            }
            if (course == "") {
                $('#updateCourse').css('border-color', 'red');
                return false;
            }
            $.ajax({
                url: 'action.php',
                type: 'post',
                data: {
                    updateId: updateId,
                    updateName: name,
                    updateCity: city,
                    updateCourse: course
                },
                success: function(data) {
                    $('#updateName').css('border-color', '#333');
                    $('#updateCity').css('border-color', '#333');
                    $('#updateCourse').css('border-color', '#333');
                    $('#submitForm')[0].reset();
                    $('body').removeClass('model-open');
                    console.log(data);
                    ReadData();

                }
            })
        });
        //delete function
        function deleteData(value) {
            var confirmation = confirm("Do you want to delete data");
            if (confirmation == true) {
                $.ajax({
                    url: 'action.php',
                    type: 'post',
                    data: {
                        dataId: value
                    },
                    success: function(data) {
                        ReadData();
                    }
                });
            }
        }

        // close Model
        $('#modelClose').click(function() {
            $('body').removeClass('model-open');
        });
        $('.model').click(function() {
            $('body').removeClass('model-open');
        });
        $('.model .form').click(function(e) {
            e.stopPropagation();
        });

    </script>
</body>

</html>
