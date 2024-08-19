<?php
include("../wp-config.php");
session_start();
global $wpdb;

if (isset($_POST['submit_profile'])) {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "You are not logged in.";
        exit;
    }

    $userId = $_SESSION['user_id'];
    $newFirstName = $_POST['firstname'];
    $newLastName = $_POST['lastname'];
    $newEmail = $_POST['email'];
    $newPosition = $_POST['position'];

    $wpdb->update(
        'wp_employees',
        array(
            'first_name' => $newFirstName,
            'last_name' => $newLastName,
            'email_address' => $newEmail,
            'position' => $newPosition
        ),
        array('id' => $userId) // Assuming 'id' is the primary key column
    );

    if ($wpdb->rows_affected > 0) {
        header("Location: profile.php");
    } else {
        echo 'Error updating profile data.';
    }
}

if (isset($_POST['submit_password'])) {
    // Check if the user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo "You are not logged in.";
        exit;
    }

    $userId = $_SESSION['user_id'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Retrieve the user from the database
    $user = $wpdb->get_row(
        $wpdb->prepare(
            "SELECT * FROM wp_employees WHERE id = %d",
            $userId
        )
    );

    if ($user && password_verify($oldPassword, $user->password)) {
        // Validate the new password
        if (empty($newPassword) || empty($confirmPassword)) {
            echo "Please enter a new password and confirm it.";
        } elseif ($newPassword !== $confirmPassword) {
            echo "The new password and confirm password do not match.";
        } else {
            // Generate a new hashed password
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the database
            $wpdb->update(
                'wp_employees',
                array('password' => $newHashedPassword),
                array('id' => $userId)
            );

            echo "Password changed successfully.";
        }
    } else {
        echo "Invalid old password.";
    }
}
?>