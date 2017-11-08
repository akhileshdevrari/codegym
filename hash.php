<?php

$hash=password_hash("rasmuslerdorf", PASSWORD_DEFAULT);
if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>