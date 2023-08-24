<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>Promo Code</title>
    <style>
        body{
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('back.jpg');
            background-size: cover;
            color: white;
        }

        #container{
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            width: 30vw;
            height: 50vh;
            background-image: url('back2.jpg');
            background-size: cover;
            border-radius: 50px;
        }

        #part1{
            width: 80%;
        }

        #part2{
            width: 80%;
        }

        #apply{
            border: none;
            background-color: #9ed368;
            padding: 10px;
        }

        #apply:hover{
            background-color: #8bc052;
        }

        #edit{
            border: none;
            background-color: #ced368;
            padding: 10px;
        }

        #edit:hover{
            background-color: #c0bc52;
        }

        @media screen and (max-width: 1250px){
            #container{
                width: 50vw;
            }
        }

        @media screen and (max-width: 800px){
            #container{
                width: 70vw;
            }
        }

        @media screen and (max-width: 800px){
            #container{
                width: 90vw;
            }

            h2{
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <h2>PROMO CODE APPLIER</h2>
        <div class="form-group" id="part1">
            <label for="email">Total Price:</label>
            <input type="text" class="form-control" id="total_price" name="total_price" placeholder="1000.00">
        </div>
        <div class="form-group" id="part2">
            <label for="promo-code">Apply Promocode:</label>
            <input type="text" class="form-control" id="coupon_code" placeholder="Apply Promocode" name="coupon_code">
            <b><span id="message" style="color:#9ed368; font-size: larger;"></span></b>
        </div>
        <button id="apply" class="btn btn-default">Apply</button>
        <button id="edit" class="btn btn-default" style="display:none">Edit</button>
    </div>
    <script>
        $("#apply").click(function(){
            if ($('#coupon_code').val() != '') {
                $.ajax({
                    type: "POST",
                    url: "process.php",
                    data:{
                        coupon_code: $('#coupon_code').val()
                    },
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            var after_apply=$('#total_price').val()-dataResult.value;
                            $('#total_price').val(after_apply);
                            $('#apply').hide();
                            $('#edit').show();
                            $('#message').html("Promocode applied successfully!");
                        }
                        else if(dataResult.statusCode==201){
                            $('#message').html("Invalid promocode!");
                        }
                    }
                });
            }
            else{
                $('#message').html("Promocode can not be blank. Enter a valid promocode!");
            }
        });
        $("#edit").click(function(){
            $('#coupon_code').val("");
            $('#apply').show();
            $('#edit').hide();
            location.reload();
        });
    </script>
</body>

</html>