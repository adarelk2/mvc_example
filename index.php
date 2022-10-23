<?php
define("remove_cashe",rand(10000,99999));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   
    <script src="/javascript/Classes/Table.js?<?=remove_cashe;?>"></script>
    <script src="/javascript/Classes/Vertical_Table.js?<?=remove_cashe;?>"></script>
    <script src="/javascript/view/home.js?id=<?=remove_cashe;?>" type="module"></script>

</head>
<body>
    <h3 class="text-center">Users List</h3>
    <div class="form-group col-5 mx-auto text-center">
        <label for="name">full Name:
            <input type='text' id="name" class="form-control">
        </label>
    </div>

    <div class="form-group col-5 mx-auto text-center mt-3">
       <button class="btn btn-primary getNewUsers">Load new 5 users</button>
    </div>
    <div class="show_list"></div>
</body>
</html>