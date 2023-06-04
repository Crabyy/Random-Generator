// Generate random password
function generateRandomPassword(inputId) {
    var passwordLength = 30;
    var password = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*().';

    for (var i = 0; i < passwordLength; i++) {
        var randomIndex = Math.floor(Math.random() * characters.length);
        password += characters.charAt(randomIndex);
    }

    document.getElementById(inputId).value = password;
}

$(document).ready(function() {
    // Fetch data on page load
    fetchData();

    // Create item
    window.createItem = function() {
        var name = $('#name').val();
        var password = $('#password').val();
        $.ajax({
            url: 'inc/api.php',
            type: 'POST',
            data: {
                action: 'create',
                name: name,
                password: password
            },
            success: function(response) {
                $('#createModal').modal('hide');
                $('#name').val('');
                $('#password').val('');
                fetchData();
            }
        });
    };

    // Edit item
    window.editItem = function(id, name, password) {
        $('#editName').val(name);
        $('#editPassword').val(password);
        $('#editItemId').val(id);
        $('#editModal').modal('show');
    };

    // Update item
    window.updateItem = function() {
        var id = $('#editItemId').val();
        var name = $('#editName').val();
        var password = $('#editPassword').val();
        $.ajax({
            url: 'inc/api.php',
            type: 'POST',
            data: {
                action: 'update',
                id: id,
                name: name,
                password: password
            },
            success: function(response) {
                $('#editModal').modal('hide');
                fetchData();
            }
        });
    };

    // Delete item
    window.deleteItem = function(id) {
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: 'inc/api.php',
                type: 'POST',
                data: {
                    action: 'delete',
                    id: id
                },
                success: function(response) {
                    fetchData();
                }
            });
        }
    };

    // Fetch data from the server
    function fetchData() {
        $.ajax({
            url: 'inc/api.php',
            type: 'GET',
            data: {
                action: 'fetch'
            },
            success: function(response) {
                $('#tableBody').html(response);
            }
        });
    }
});
