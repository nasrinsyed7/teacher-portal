<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header('Location: index.php');
    exit;
}

include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_student'])) {
        if (isset($_POST['name'], $_POST['subject'], $_POST['marks'])) {
            $name = $_POST['name'];
            $subject = $_POST['subject'];
            $marks = $_POST['marks'];

            $stmt = $con->prepare("SELECT id FROM students WHERE name = ? AND subject = ?");
            $stmt->bind_param("ss", $name, $subject);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id);
                $stmt->fetch();
                $stmt = $con->prepare("UPDATE students SET marks = ? WHERE id = ?");
                $stmt->bind_param("ii", $marks, $id);
                $stmt->execute();
            } else {
                $stmt = $con->prepare("INSERT INTO students (name, subject, marks) VALUES (?, ?, ?)");
                $stmt->bind_param("ssi", $name, $subject, $marks);
                $stmt->execute();
            }
        } else {
            echo "Required fields are missing!";
        }
    }

    if (isset($_POST['edit_student'])) {
        if (isset($_POST['id'], $_POST['name'], $_POST['subject'], $_POST['marks'])) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $subject = $_POST['subject'];
            $marks = $_POST['marks'];

            $stmt = $con->prepare("UPDATE students SET name = ?, subject = ?, marks = ? WHERE id = ?");
            $stmt->bind_param("ssii", $name, $subject, $marks, $id);
            $stmt->execute();
        } else {
            echo "Required fields are missing!";
        }
    }

    if (isset($_POST['delete_student'])) {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];

            $stmt = $con->prepare("DELETE FROM students WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        } else {
            echo "Student ID is missing!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Teacher Portal - Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
      
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #d3d3d3;
            color: #000; 
        }
        .container {
            padding: 20px;
            background-color: #fff; 
            box-shadow: 0 2px 10px 0 rgb(127, 126, 126);
        }
        .head {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h2, h4 {
            color: #000;
        }
        .table {
            background-color: #f0f0f0; 
            color: #000; 
        }
        .table th, .table td {
            border: 1px solid #ccc; 
        }
        .btn {
            color: #fff;
            font-size: 14px;
            background-color: black;
            padding: 6px 34px;
            border: none;
        }
        .btn:hover {
            color: #000;
            background-color: #fff;
        }
        .action-buttons {
            display: none;
        }
        .dropdown-icon {
            font-size: 20px;
            cursor: pointer;
        }
        .btn-home-logout {
            color: #fff;
            background-color: #000;
            border: none;
            margin-right: 10px;
        }
        .btn-home-logout:hover {
            color: #000;
            background-color: #fff;
        }
        .form-group i {
            position: relative;
            top: -25px;
            left: 10px;
        }
        .form-group input {
            padding: 7px 40px;
            cursor: pointer;
        }
        .modal-body {
            padding: 15px 35px;
        }
        .modal-body .add-btn1 {
            width: 70%;
            padding: 15px 0;
            background-color: black;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            justify-content: center;
        }
        .add-btn1 #btn-info {
            cursor: pointer;
            background-color: black;
            width: 100%;
            color: white;
            font-size: 15px;
            border: none;
        }
        .avatar {
            display: inline-block;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #2196f3; 
            color: white;
            text-align: center;
            line-height: 32px;
            font-size: 16px;
            font-weight: bold;
            margin-right: 8px; 
        }

        .avatar::before {
            content: attr(data-initial); 
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#studentTable').DataTable();

            $('.dropdown-icon').on('click', function() {
                $(this).siblings('.action-buttons').toggle();
            });

            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var subject = $(this).data('subject');
                var marks = $(this).data('marks');
                
                $('#editStudentModal #edit_id').val(id);
                $('#editStudentModal #edit_name').val(name);
                $('#editStudentModal #edit_subject').val(subject);
                $('#editStudentModal #edit_marks').val(marks);
            });

            $('.delete-btn').on('click', function() {
                var id = $(this).data('id');
                $('#deleteStudentModal #delete_id').val(id);
            });
        });

        function editStudent() {
            $('#editStudentModal form').submit();
        }

        function deleteStudent() {
            $('#deleteStudentModal form').submit();
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="head">
            <h2 style="color:red">tailwebs.</h2>
            <div class="header">
                <button class="btn btn-home-logout" onclick="window.location.href='home.php'">Home</button>
                <button class="btn btn-home-logout" onclick="window.location.href='logout.php'">Logout</button>
            </div>
        </div>
       
        <table class="table table-bordered table-striped table-hover" id="studentTable">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Subject</th>
                    <th class="text-center">Marks</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $con->query("SELECT * FROM students");
                while ($row = $result->fetch_assoc()) {
                    $initial = strtoupper($row['name'][0]);
                    echo "
                    <tr>
                        <td class='text-left'>
                            <div class='avatar' data-initial='{$initial}'></div>
                            {$row['name']}
                        </td>
                        <td class='text-left'>{$row['subject']}</td>
                        <td class='text-left'>{$row['marks']}</td>
                        <td class='text-center'>
                            <i class='fa fa-caret-down dropdown-icon'></i>
                            <div class='action-buttons'>
                                <button class='btn btn-warning edit-btn' data-toggle='modal' data-target='#editStudentModal'
                                    data-id='{$row['id']}' data-name='{$row['name']}' data-subject='{$row['subject']}' data-marks='{$row['marks']}'
                                    title='Edit'>Edit</button>
                                <button class='btn btn-danger delete-btn' data-toggle='modal' data-target='#deleteStudentModal'
                                    data-id='{$row['id']}' title='Delete'>Delete</button>
                            </div>
                        </td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#addStudentModal">Add</button>
    </div>

    <div id="addStudentModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="add_student" value="1">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" required>
                            <i class="fa-regular fa-message"></i>
                        </div>
                        <div class="form-group">
                            <label for="marks">Marks</label>
                            <input type="number" class="form-control" id="marks" name="marks" placeholder="Enter marks" required>
                            <i class="fa-regular fa-bookmark"></i>
                        </div>
                        <div class="add-btn1">
                            <button type="submit" id="btn-info">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="editStudentModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Student</h4>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="edit_student" value="1">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="form-group">
                            <label for="edit_name">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_subject">Subject</label>
                            <input type="text" class="form-control" id="edit_subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_marks">Marks</label>
                            <input type="number" class="form-control" id="edit_marks" name="marks" required>
                        </div>
                        <button type="button" class="btn btn-info" onclick="editStudent()">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="deleteStudentModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Student</h4>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="delete_student" value="1">
                        <input type="hidden" id="delete_id" name="id">
                        <p>Are you sure you want to delete this student?</p>
                        <button type="button" class="btn btn-danger" onclick="deleteStudent()">Delete</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
