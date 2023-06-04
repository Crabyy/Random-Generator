// Generate random password
function generateRandomPassword(inputId) {
    var passwordLength = 71;
    var password = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*().';

    for (var i = 0; i < passwordLength; i++) {
        var randomIndex = Math.floor(Math.random() * characters.length);
        password += characters.charAt(randomIndex);
    }

    document.getElementById(inputId).value = password;
}

// Fetch all items
function fetchItems() {
    $.ajax({
        url: 'inc/api.php?action=fetch',
        method: 'GET',
        success: function (data) {
            $('#tableBody').html(data);
        }
    });
}

// Create new item
function createItem() {
    var name = $('#name').val();
    var username = $('#username').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var others = $('#others').val();

    $.ajax({
        url: 'inc/api.php',
        method: 'POST',
        data: { action: 'create', name: name, username: username, email: email, password: password, others: others },
        success: function () {
            fetchItems();
            $('#createModal').modal('hide');
            $('input').val('');
        }
    });
}

// Edit item
function editItem(id, name, username, email, password, others) {
    $('#editName').val(name);
    $('#editUsername').val(username);
    $('#editEmail').val(email);
    $('#editPassword').val(password);
    $('#editOthers').val(others);
    $('#editItemId').val(id);
    $('#editModal').modal('show');
}

// Update item
function updateItem() {
    var id = $('#editItemId').val();
    var name = $('#editName').val();
    var username = $('#editUsername').val();
    var email = $('#editEmail').val();
    var password = $('#editPassword').val();
    var others = $('#editOthers').val();

    $.ajax({
        url: 'inc/api.php',
        method: 'POST',
        data: { action: 'update', id: id, name: name, username: username, email: email, password: password, others: others },
        success: function () {
            fetchItems();
            $('#editModal').modal('hide');
        }
    });
}

// Delete item
function deleteItem(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        $.ajax({
            url: 'inc/api.php',
            method: 'POST',
            data: { action: 'delete', id: id },
            success: function () {
                fetchItems();
            }
        });
    }
}

$(document).ready(function () {
    fetchItems();
});
