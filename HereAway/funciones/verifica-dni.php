<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
            function verificaDni($dni){
                $numbers = substr($dni, 0, -1);
                if (is_numeric($numbers)){
                    $letter = strtoupper(substr($dni, -1));    
                    if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23, 1) == $letter){
                        return true;
                    }
                    return false;
                }
            }
    ?>    
</body>
</html>