<?php
// sanitizing
function sanitizeString($str)
{
  return htmlspecialchars(filter_var($str, FILTER_SANITIZE_STRING));
}

function sanitizeURL($str)
{
  return htmlspecialchars(filter_var($str, FILTER_SANITIZE_URL));
}

function sanitizeInt($str)
{
  return htmlspecialchars(filter_var($str, FILTER_SANITIZE_NUMBER_INT));
}

function ppa($arr) {
  echo "<pre>";
  print_r($arr);
  echo "</pre>";
  die();
}