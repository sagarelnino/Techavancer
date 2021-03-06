<?php
require 'session_required.php';
require 'connection.php';
$page = 'add_word';
if(isset($_POST['submit'])){
    $japanese = filter($_POST['japanese']);
    $japanese = unpack("C*", $japanese);
    $japanese = json_encode($japanese);
    $english = filter($_POST['english']);
    $lessonNo = filter($_POST['lessonNo'][0]);
    $details = filter($_POST['pronounciation']);
    $created  = date('Y-m-d H:i:s');
    if(!$user->isExistWord($japanese)){
        $user->addWord($japanese,$english,$lessonNo,$details,$created);
        $_SESSION['message'] = 'Word Successfully Added!!';
    }else{
        $_SESSION['message'] = 'The word already exists';
    }
}
function filter($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Word</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/julogo.ai-converted.ico">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="utilities/css/style.css">
</head>
<body>
<?php include 'navbar_admin.php'; ?>
<div class="my-body">
    <h2 class="text-center">Add Word!</h2>
    <?php
    if(!empty($_SESSION['message'])){?>
        <h3 style="color: red" class="text-center"><?php echo $_SESSION['message']?></h3>
    <?php }
    unset($_SESSION['message']);
    ?>
    <div class="col-md-offset-3 col-md-6 my-form">
        <form class="form-horizontal" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-2" for="japanese">Japanese:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="japanese" id="japanese" placeholder="Enter Japanese" required>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="english">English:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="english" id="english" placeholder="Enter English">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="lessonNo">Lesson No:</label>
                <div class="col-sm-10">
                    <select class="form-control" name="lessonNo[]" id="lessonNo">
                        <option value="22">22</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="pronounciation">Pronouncing:</label>
                <div class="col-sm-10">
                    <input type="text" name="pronounciation" id="pronounciation" class="form-control" placeholder="Enter pronounciation in english">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit"  name="submit" value="Add Word" class="btn btn-info">
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script src="utilities/js/jquery.js"></script>
</body>
</html>