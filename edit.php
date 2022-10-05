<?php require_once('./editor.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EDITOR: Cassie's Horror Movie Advent 2022</title>
  <meta name="description" content="Explore a fresh set of Horror movies this year by watching a freaky flick each day of the month of October leading up to Halloween">
  <meta name="keywords" content="horror, movies, advent, halloween">
  <meta name="robots" content="index, nofollow">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="language" content="English">
  <link rel="stylesheet" href="style.css?<?php echo filemtime('style.css'); ?>">
</head>
<body class="editor">
  <h1>Cassie's Horror Movie Advent 2022</h1>
  <table>
    <thead>
      <tr>
        <td>Date</td>
        <td>Title</td>
        <td>Availibility</td>
        <td>IMDB Link</td>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($movies_list_json as $key => $movie) {
          $current_day = match_current_date($movie->date);
          echo "
<tr tabindex='0' role='button'{$current_day}>
  <td>{$movie->date}</td>
  <td data-name='{$key}-title' contenteditable>{$movie->title}</td>
  <td data-name='{$key}-availability' contenteditable>{$movie->availability}</td>
  <td data-name='{$key}-tooltip' contenteditable>{$movie->tooltip}</td>
</tr>";
        }
      ?>
    </tbody>
  </table>
  <div class="footer">
    Password: <input name="password" type="password">
    <button>Save</button>
  </div>
  <script>
    const saveButton = document.querySelector('.footer button')
    const passwordField = document.querySelector('.footer input')

    const saveHandler = evnt => {
      if (evnt.key && evnt.key !== 'Enter') return;
      evnt.preventDefault()

      const data = [];
      [...document.querySelectorAll('td[contenteditable]')].forEach(item => {
        const id = item.dataset.name.split('-')[0]
        const key = item.dataset.name.split('-')[1]
        data[id] = data[id] ?? {}
        data[id][key] = item.textContent
      })

      const form = document.createElement('form')
      form.method = 'POST'
      form.action = window.location.href
      document.querySelector('body').appendChild(form)

      form.innerHTML = `<textarea name="data">${JSON.stringify(data)}</textarea>`
      form.prepend(passwordField)
      form.submit()
    }

    saveButton.addEventListener('click', saveHandler)
    passwordField.addEventListener('keydown', saveHandler)
  </script>
</body>
</html>