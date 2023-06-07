<!DOCTYPE html>
<html>
<head>
    <title>CRUD Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <h2 class="table mt-4">Personal Random Generator</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">Create</button>
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Website</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Others</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="text" class="form-control" id="password" required>
                        <button type="button" class="btn btn-primary" onclick="generateRandomPassword('password')">Generate Random Password</button>
                    </div>
                    <div class="form-group">
                        <label for="others">Others:</label>
                        <input type="text" class="form-control" id="others">
                    </div>        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="createItem()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Item</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editName">Name:</label>
                        <input type="text" class="form-control" id="editName" required>
                    </div>
                    <div class="form-group">
                        <label for="editUsername">Username:</label>
                        <input type="text" class="form-control" id="editUsername" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email:</label>
                        <input type="email" class="form-control" id="editEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Password:</label>
                        <input type="text" class="form-control" id="editPassword" required>
                        <button type="button" class="btn btn-primary" onclick="generateRandomPassword('editPassword')">Generate Random Password</button>
                    </div>
                    <div class="form-group">
                        <label for="editOthers">Others:</label>
                        <input type="text" class="form-control" id="editOthers">
                    </div>
                    <input type="hidden" id="editItemId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateItem()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
