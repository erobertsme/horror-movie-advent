<?php
require_once 'options.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  $password = $_POST['password'];
  if ($password !== PASSWORD) return header("Location: ?status=failed");
  unset($_POST['password']);

  $movies = json_decode($_POST['data']);

  foreach ( $movies as $i => $movie ) {
    $date = new Datetime("Oct ".$i+1);
    $movie->date = $date->format('M d');
  }

  $data = json_encode($movies, JSON_PRETTY_PRINT);

  file_put_contents(
    './movies.json',
    $data
  );

  header("Location: ?status=updated");

  return;
}

$movies_list_json_str = file_get_contents('./movies.json', true);
$movies_list_json = json_decode($movies_list_json_str);

function match_current_date($date_str) {
  $current_date = date('M d');
  return $date_str == $current_date ? ' class="current-day"' : '';
}