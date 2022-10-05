<?php
function match_current_date($date_str) {
  $current_date = date('M d');
  return $date_str == $current_date ? ' class="current-day"' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cassie's Horror Movie Advent 2022</title>
  <meta name="description" content="Explore a fresh set of Horror movies this year by watching a freaky flick each day of the month of October leading up to Halloween">
  <meta name="keywords" content="horror, movies, advent, halloween">
  <meta name="robots" content="index, nofollow">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="language" content="English">
  <link rel="stylesheet" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>
<body>
  <h1>Cassie's Horror Movie Advent 2022</h1>
  <?php
    $movies_list_json_str = file_get_contents('./movies.json', true);
    $movies_list_json = json_decode($movies_list_json_str);
  ?>

  <table>
    <thead>
      <tr>
        <td>Date</td>
        <td>Title</td>
        <td>Availibility</td>
      </tr>
    </thead>
    <tbody>
      <?php
        ob_start();
        foreach ($movies_list_json as $movie):
          $current_day = match_current_date($movie->date); ?>

      <tr tabindex="0" role="button"<?php echo $current_day; ?>>
        <td><?php echo $movie->date; ?></td>
        <td><?php echo $movie->title; ?></td>
        <td>
          <?php echo $movie->availability; ?>

          <?php if ( $movie->tooltip !== '' ):
            ?><div class="tooltip"><a href="<?php echo $movie->tooltip; ?>" target="_blank">IMDB</a></div><?php
          endif; ?>

        </td>
      </tr>
      <?php endforeach;
      echo ob_get_clean();
      ?>

    </tbody>
  </table>
</body>
</html>