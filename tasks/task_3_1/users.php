<?php
  $page = 1;
  $page_size = 3;

  require_once './include/crud.php';
  require_once './include/database.php';
  
  $lastPage = get_users_count($link, $page_size);

  if (isset($_POST['next'])) {
    $page = $_POST['page'];
  } elseif (isset($_POST['previous']) && $_POST['page'] > 0) {
    $page = $_POST['page'];
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Users</title>
  </head>
  <body>
    <?php include "include/base.php"?>
    <div class="container">
      <div class="card">
        <div class="card-body">
          <div class="card-title text-center">
            <h1>Users</h1>
          </div>
          <div class="card-text">
            <table class="table">
              <thead class="table-dark">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Login</th>
                  <th scope="col">Password</th>
                  <th scope="col">Date added</th>
                </tr>
              </thead>
              <tbody>
                <?php $users = get_users($link, $page, $page_size); ?>
                <?php foreach($users as $user): ?>
                  <tr>
                    <th scope="col" class='align-middle'><?=$user['id']?></th>
                    <th scope="col" class='align-middle'><a href="users/edit.php?id=<?=$user['id']?>" class="link-info"><?=$user['login']?></a></th>
                    <th scope="col" class='align-middle'><?=$user['password']?></th>
                    <th scope="col" class='align-middle'><?=$user['date_added']?></th>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <div class="card-text d-flex flex-row justify-content-between">
            <form action="users.php" method='post'>
              <input type="hidden" name='page' value=<?=$page-1?>>
              <input type="hidden" name='previous' value="previous">
            <?php if($page > 1): ?>
              <input class='btn btn-secondary' type="submit" value='Previous'>
            <?php endif; ?>
            </form>
            <form action="users.php" method='post'>
              <input type="hidden" name='page' value=<?=$page+1?>>
              <input type="hidden" name='next' value="next">
            <?php if($page < $lastPage): ?>
              <input class='btn btn-secondary pl-4' type="submit" value='Next'>
            <?php endif; ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
