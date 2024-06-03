<?php
function emptyStateTemplate($text){
    $template =  '
    <div class="empty-state-wrapper">
        <img src="#" alt="empty state">
        <p class="text-body1">'. $text . '</p>
    </div>
    ';
    return $template;
}