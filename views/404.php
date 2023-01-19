<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 Page</title>
    <link rel="stylesheet" href="/public/css/404.css">
  </head>
  <body>
    <div id="background"></div>
    <div class="top">
      <h1>404</h1>
      <h3>page not found</h3>
    </div>
    <div class="container">
      <div class="ghost-copy">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
        <div class="four"></div>
      </div>
      <div class="ghost">
        <div class="face">
          <div class="eye"></div>
          <div class="eye-right"></div>
          <div class="mouth"></div>
        </div>
      </div>
      <div class="shadow"></div>
    </div>
    <div class="bottom">
      <p>Boo, looks like a ghost stole this page!</p>
      <div class="buttons">
        <button class="btn" onclick="window.history.go(-1); return false;">Back</button>
        <button class="btn" onclick="location.href='/'">Home</button>
      </div>
    </div>
  </body>
</html>
