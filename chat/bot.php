<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expressbot</title>

    <link rel="stylesheet" href="chat.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</head>
<body style= "background-image: URL(https://i0.wp.com/www.csscodelab.com/wp-content/uploads/2020/03/html-gradient-background-css.png?resize=300%2C196&ssl=1); background-position: center; background-repeat: no-repeat;background-size: cover;">
    <div style="height:100px;"></div>
    <div class="container">
        <?php
            if(isset($_POST['addnew'])){
                $conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Error");

                $quer = $_POST['query'];
                $rep = $_POST['Reply'];

                $addnewkeyword = "INSERT INTO `chatbot` (`id`, `queries`, `replies`) VALUES (NULL, '$quer', '$rep')";
                if ($conn->query($addnewkeyword) === TRUE) {
                    echo " <div class='alert alert-light text-success text-center fw-bold' role='alert'>
                                New record created successfully
                            </div>
                    ";
                    header('refresh:2;URL=bot.php');
                } else {
                    echo " <div class='alert alert-light text-success text-center fw-bold' role='alert'>
                                Faild to add New record
                            </div>
                    ";
                }
                $conn->close();
            }
        ?>
    </div>
    <section>
        <div class="container " > 
        <div class="row bg-info" style ="border-radius:20px;">
                <div class="col-4 text-end">
                <img class="mt-2" src="https://media.istockphoto.com/illustrations/robot-chat-robot-talking-robot-portrait-artwork-illustration-id1091239452?k=6&m=1091239452&s=170667a&w=0&h=4zJtfDBctledBdna91wzSXRC0y3TviuZ2A4Z52Bthzc=" class="" style="width:90px; border-radius:50%;"alt="">
                </div>
                <div class="col-6">
                    <p class="display-1 fw-bold text-light">Expressbot</p>
                </div>
                <div class="col-md-2 mt-4 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add">
                        <i class="fa fa-plus" style="font-size:24px:"></i>
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa fa-bars" style="font-size:24px:"></i>
                    </button>
                </div>
            </div>
        </div>
        <br>
        <div class="container border" style ="height:60vh;overflow-x: hidden;overflow-y: auto; background-color:rgba(255, 255, 255, 0.96);border-radius:50px;">
            <div class="wrapper">
                <div class="form">
                    <div class="bot-inbox inbox ">
                        <div class="row">
                            <div class="col-1">
                                <img class= "mt-2 img-fluid" src="https://media.istockphoto.com/illustrations/robot-chat-robot-talking-robot-portrait-artwork-illustration-id1091239452?k=6&m=1091239452&s=170667a&w=0&h=4zJtfDBctledBdna91wzSXRC0y3TviuZ2A4Z52Bthzc=" class="" style="width:50px; margin-left:20px; border-radius:50%;"alt="">
                            </div>
                            <div class="col-6 mt-2 fs-5 p-2 w-auto bg-info " style = border-radius:20px;>
                            Hello my Friend, how may i help you?
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="container">
                    <div class="input-group mb-3 mt-2">
                    <input type="text" id="data" class="form-control" placeholder="Type something here.." aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button id="send-btn" class="btn btn-info" type="button" id="button-addon2">Send</button>
                    </div>
                </div>
    </section>
    <br>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">LIST OF KEYWORDS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                    <th>Queries</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conn = mysqli_connect("localhost", "root", "", "bot") or die("Database Error");

                    $listofkeywords = "SELECT * FROM chatbot";
                    $result = $conn->query($listofkeywords);
                    
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row["queries"]; ?></td>
                        </tr>
                    <?php
                    }
                    } else {
                    echo "0 results";
                    }
                    $conn->close();
                ?>
                    
                </tbody>
                <tfoot>
                    <tr>
                    <th>Queries</th>
                    </tr>
                </tfoot>
            </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  
            </div>
            </div>
        </div>
    </div>

<form action="" method = "post">
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD NEW KEYWORDS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label h5 text-center" for="form2Example1">Query</label>
                    <div class="form-outline mb-4">
                        <div class="row">
                        <textarea name="query" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label h5 text-center" for="form2Example1">Reply</label>
                        <div class="row">
                        <textarea name="Reply" cols="30" rows="5"></textarea>
                        </div>
                    </div>
                    
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>  
                <button type="submit" name="addnew"class="btn btn-primary">Add</button>
            </div>
            </div>
        </div>
    </div>
</form>
    <script>
        $(document).ready(function(){
            $('#example').DataTable();
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="bot-inbox inbox "> <div class="row justify-content-end"><div class="col-6 mt-2 fs-5 p-2 w-auto " style =" background-color:#91919156; border-radius:20px;">'+$value+'</div> <div class="col-1"><img class= "mt-2 img-fluid" src="https://cdn.pixabay.com/photo/2014/03/25/16/32/user-297330__480.png" class="" style="width:50px; margin-left:0px; border-radius:50%;"alt=""> </div> </div></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'message.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox "><div class="row"><div class="col-1"><img class= "mt-2 img-fluid" src="https://media.istockphoto.com/illustrations/robot-chat-robot-talking-robot-portrait-artwork-illustration-id1091239452?k=6&m=1091239452&s=170667a&w=0&h=4zJtfDBctledBdna91wzSXRC0y3TviuZ2A4Z52Bthzc=" class="" style="width:50px; margin-left:20px; border-radius:50%;"alt=""></div><div class="col-6 mt-2 fs-5 p-2 w-auto  bg-info" style = "border-radius:20px; max-width:600px;">'+ result+'</div></div></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
    </script>
    
</body>
</html>