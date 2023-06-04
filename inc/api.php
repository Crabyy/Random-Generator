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
        $output .= '<td>' . $row['password'] . '</td>';
        $output .= '<td>';
        $output .= '<button type="button" class="btn btn-primary btn-sm" onclick="editItem(' . $row['id'] . ', \'' . $row['name'] . '\', \'' . $row['password'] . '\')">Edit</button> ';
        $output .= '<button type="button" class="btn btn-danger btn-sm" onclick="deleteItem(' . $row['id'] . ')">Delete</button>';
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
        $password = $_POST['password'];
        $stmt = $conn->prepare('INSERT INTO randomgen (name, password) VALUES (:name, :password)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }
    
    elseif ($action === 'update') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $stmt = $conn->prepare('UPDATE randomgen SET name = :name, password = :password WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }
    
    elseif ($action === 'delete') {
        $id = $_POST['id'];
        $stmt = $conn->prepare('DELETE FROM randomgen WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>
