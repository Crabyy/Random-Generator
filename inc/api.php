<?php

require_once 'dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['action'] === 'fetch') {
    // Fetch all randomgen
    $db = new Database();
    $conn = $db->getConnection();
    $stmt = $conn->prepare('SELECT * FROM randomgen');
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $output = '';
    foreach ($result as $row) {
        $output .= '<tr>';
        $output .= '<td>' . $row['name'] . '</td>';
        $output .= '<td>' . $row['username'] . '</td>';
        $output .= '<td>' . $row['email'] . '</td>';
        $output .= '<td>' . $row['password'] . '</td>';
        $output .= '<td>' . $row['others'] . '</td>';
        $output .= '<td>';
        $output .= '<button type="button" class="btn btn-primary btn-sm m-1" onclick="editItem(' . $row['id'] . ', \'' . $row['name'] . '\', \'' . $row['username'] . '\', \'' . $row['email'] . '\', \'' . $row['password'] . '\', \'' . $row['others'] . '\')">Edit</button> ';
        $output .= '<button type="button" class="btn btn-danger btn-sm m-1" onclick="deleteItem(' . $row['id'] . ')">Delete</button>';
        $output .= '<button type="button" class="btn btn-success btn-sm m-1" onclick="copyPassword(\'' . $row['password'] . '\')">Copy</button>';
        $output .= '</td>';
        $output .= '</tr>';
    }

    echo $output;
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $db = new Database();
    $conn = $db->getConnection();

    if ($action === 'create') {
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $others = $_POST['others'];

        // Check if the password already exists
        $stmt = $conn->prepare('SELECT COUNT(*) FROM randomgen WHERE password = :password');
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo '<script>alert("Error: Password already exists.");</script>';
            return;
        }

        // Insert the new item
        $stmt = $conn->prepare('INSERT INTO randomgen (name, username, email, password, others) VALUES (:name, :username, :email, :password, :others)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':others', $others);
        $stmt->execute();
    }
    
    elseif ($action === 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $others = $_POST['others'];

        // Check if the password already exists (excluding the current item)
        $stmt = $conn->prepare('SELECT COUNT(*) FROM randomgen WHERE password = :password AND id != :id');
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo '<script>alert("Error: Password already exists.");</script>';
            return;
        }

        // Update the item
        $stmt = $conn->prepare('UPDATE randomgen SET name = :name, username = :username, email = :email, password = :password, others = :others WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':others', $others);
        $stmt->execute();
    }
    
    elseif ($action === 'delete') {
        $id = $_POST['id'];
        $stmt = $conn->prepare('DELETE FROM randomgen WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
