<?php
function errorTemplate($error) {
    $template = "
    <div class='error-wrapper'>
      <img src='../assets/icons/alert.svg'>
      <p class='text-button email-validation-text error'>" .$error ."</p>
    </div>
    ";
    return $template;
  }
