<?php

// Assuming you have already established a database connection ($conn)
require_once 'db_connect.php';

// Prepare the SQL statement with a parameter
  $sql = "UPDATE users SET biography = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);

  // Bind the parameter values
  $stmt->bind_param("si", $biography, $userId);

  // Set the parameter values
  $biography = "Te's'@3#t 1 ";
  $userId = 1; // Replace with the actual user ID

  // Execute the prepared statement
  if ($stmt->execute()) {
    // Update successful
    echo "Biography updated successfully.";
  } else {
    // Error updating biography
    echo "Error updating biography: " . $stmt->error;
  }

  $stmt->close();

?>