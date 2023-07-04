<?php
require 'Database.php';
$PDO = Database::letsconnect();

$editmode = "oldrecord";

//Generating Primary Key
$new_Book_no = "";
$btn_Create_New = "";
$btn_status = "disabled";
$btn_Submit = "disabled";
$btn_status_one = "";


if (isset($_POST['btn_Create_new'])){


    $btn_Create_New = 'disabled';
    $btn_status = "";
    $btn_Submit = "";
    $btn_status_one = "disabled";

    $sql= "select Book_no from bookinfo order by Book_no";

    foreach ($PDO->query($sql) as $row){

        $last_Book_no = $row['Book_no'];
        $num_Book_no=(int)(substr($last_Book_no, -3))+1;
        $new_Book_no = sprintf('%04d',$num_Book_no);
    }

    $editmode = "NewRecord";

}

//--------

if(isset($_POST['btn_Submit'])){

    $editmode = $_POST['editmode'];

    $Book_no = $_POST['txt_Book_no'];
    $Title_of_the_Book = $_POST['txt_Title_of_the_Book'];
    $Authors_Name = $_POST['txt_Authors_name'];
    $Country = $_POST['drpdwnCountry'];
    $Genre = $_POST['drpdwnGenre'];
    $Types_of_Book = $_POST['drpdwnTypes_of_book'];
    $Price = $_POST['drpdwnPrice'];


    if ($editmode == "NewRecord"){ 

        $PDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into bookinfo values(?,?,?,?,?,?,?);";
        $q = $PDO->prepare($sql);
        $q->execute(array($Book_no, $Title_of_the_Book,  $Authors_Name, $Country, $Genre, $Types_of_Book, $Price));
    }

    else{
        $PDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "update bookinfo set Book_no=?, Title_of_the_Book=?, Authors_Name=?, Country=?, Genre=?, Types_of_Book=?, Price=? where Book_no=?";
        $q = $PDO ->prepare($sql);
        $q->execute(array($Book_no, $Title_of_the_Book,  $Authors_Name, $Country, $Genre, $Types_of_Book, $Price, $Book_no));
    }

    $editmode = "oldrecord"; 
}

if(isset($_POST['btn_edit'])) {
    $editmode = "EDIT";
    $index = key($_POST['btn_edit']);
    $array_Book_no = $_POST['hideBook_no'];
    $Book_no = $array_Book_no[$index];
    $sql = "select * from bookinfo where Book_no = '".$Book_no."'";
    $q = $PDO -> prepare($sql);
    $q -> execute(array($Book_no));
    $data = $q -> fetch(PDO::FETCH_ASSOC);
    $Book_no = $data['Book_no'];
    $Title_of_the_Book = $data['Title_of_the_Book'];
    $Authors_Name = $data['Authors_Name'];
    $Country = $data['Country'];
    $Genre = $data['Genre'];
    $Types_of_Book = $data['Types_of_Book'];
    $Price = $data ['Price'];

    $editmode = "EDIT";
    $btn_status_one = "disabled";
}


if (isset($_POST['btndelete'])) {
    $index=key($_POST['btndelete']);
    $array_Book_no=$_POST['hideBook_no'];
    $Book_no = $array_Book_no[$index];
    $sql = "delete from bookinfo where Book_no='".$Book_no."'";
    $PDO -> query($sql);
    $btn_status_one = "disabled";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>

    </head>

    <style type="text/css">         


        .divback {
            margin-top: 20px;
            background-color:ghostwhite; 
            width: 240px;
            height: 50px;
            margin-left: 60px;
            font-family: fantasy;
            font-size: 30px;
            text-align: center;
          
        }
        
        input[type=text], select {
            width: 350px;
            padding: 12px 20px;
            margin-left: 60px;
            margin-top: 50px;
            display: inline-block;
            border: 1px solid black;
            border-radius: 4px;
            box-sizing: border-box;
        }

        body {
            background-size:1566px 800px;
            background-repeat:no-repeat;
        }

        .Country {
            width: 350px;
            height: 50px;
            padding: 0px 20px;
            margin-left: 60px;
            display: inline-block;
            border: 1px solid black;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .Genre {
            width: 350px;
            height: 50px;
            padding: 0px 20px;
            margin-left: 62px;
            display: inline-block;
            border: 1px solid black;
            border-radius: 4px;
            box-sizing: border-box;

        }

        .Books {
            width: 350px;
            height: 50px;
            padding: 0px 20px;
            margin-left: 58px;
            display: inline-block;
            border: 1px solid black;
            border-radius: 4px;
            box-sizing: border-box;

        }

        .Price {
            width: 150px;
            height: 50px;
            padding: 10px 20px;
            margin-left: 60px;
            margin-top: -10px;
            display: inline-block;
            border: 1px solid black;
            border-radius: 4px;
            box-sizing: border-box;
        }

        select {
            width: 350px;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid black;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100px;
            background-color: #4CAF50;
            color: white;
            padding: 12px 10px;
            margin-left: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-outline-danger {
            margin-left: 15px;
            height: 50px;
            width: 80px;
            color: black;
            font-size: 17px;
            font-family: fantasy;
        }

        .btn-outline-success {
            margin-left: 86px;
            margin-top: 20px;
            height: 50px;
            color: black;
            font-size: 17px;
            font-family: fantasy;

        }

        .btn-outline-secondary {
            margin-left: 10px;
            height: 50px;
            color: black;
            font-size: 17px;
            font-family: fantasy;

        }

        .btn-outline-primary {
            margin-left: 15px;
            margin-top: 20px;
            height: 50px;
            color: black;
            font-size: 17px;
            font-family: fantasy;
        }

        .btn-outline-info {
            margin-left: 15px;
            height: 50px;
            width: 80px;
            color: black;
            font-size: 17px;
            font-family: fantasy;

        }

        .table-hover {
            margin-top: 80px;
            width: 1350px;
            font-family: fantasy;
            padding: 12px 10px; 
        }

        .tdtable {
            background-color:lightslategray; 
            text-align:center; 
            font-size:25px;
            
        }

        input[type=button] {
            width: 100px;
            background-color: #4CAF50;
            color: white;
            padding: 12px 10px;
            margin-left: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }


        input[type=submit]:hover {
            background-color: #45a049;
        }

        ul {
            list-style-type: none;
            overflow: hidden;
            background-color: black;
            text-align: center;
            font-size: 20px;
        }


        li {
            float: left;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover {
            background-color: black;
        }


    </style>
    </head>
<body background= "PurBook3.jpg">

    <?php

    if ($editmode == "oldrecord"){

        echo "<form method='post'>

    <ul>
        <li><a class='active' href='#home'>Home</a></li>
        <li><a href='#news'>News</a></li>
        <li><a href='#contact'>Contact</a></li>
        <li style='float:right'><a href='bookHTML.html'>Go Back To Homepage</a></li>
    </ul>

<div class='divback'><p>Book Information</p></div>
   
    <input type='text' name='txt_Book_no' placeholder='Enter book no. e.g 101' maxlength='3' pattern='[0-4]{1,3}' title='Book number consist numbers only, letters are invalid' ".$new_Book_no." readonly>

    <input type='text' name='txt_Title_of_the_Book' placeholder='e.g Everyday' maxlength='40' patter='[a-z A-Z a-Z A-z ñ]{1,1}' title='Two book title are not allowed' $btn_status required>

    <input type='text' name='txt_Authors_name' placeholder='Enter the Authors Name' maxlength='40' pattern='[a-z A-Z a-Z A-z ñ]{1}' title=' The Authors name must be only one, two authors cant be accepted' $btn_status required>

  <select class='Country' name='drpdwnCountry' title='Input the right country of the book' $btn_status required>
                            <option value=''>Choose a Country</option>
                            <option value='australia'>Australia</option>
                            <option value='canada'>Canada</option>
                            <option value='usa'>USA</option>
                            <option value='korea'>Korea</option>
                            <option value='new york'> New York</option>
                            <option value='atlanta'> Atlanta</option>
                            <option value='netherlands'>Netherlands</option>
                        </select> 

   <select class='Genre' name='drpdwnGenre' title='Input the right genre of the book, don't leave this blank' $btn_status required>
                            <option value=''>Choose a Genre</option>
                            <option value='fantasy'>Fantasy</option>
                            <option value='fiction'>Fiction</option>
                            <option value='non-fiction'>Non-Fiction</option>
                            <option value='drama'>Drama</option>
                            <option value='satire'>Satire</option>
                            <option value='Romance'>Romance</option>
                            <option value='comedy'>Comedy</option>
                            <option value='Mystery/Thriller'>Mystery/Thriller</option>
                            <option value='Horror'> Horror</option>
                            <option value='Advenure and Action'> Advenure and Action</option>
                            <option value='Science fiction'>Science fiction</option>
                            <option value='Fairytale'>Fairytale</option>
                        </select> 


    <select class='Books' name='drpdwnTypes_of_book' title='Choose the right type of book for you, don't leave this blank' $btn_status required>
                            <option value=''>Choose a Book</option>
                            <option value='journal'>Journal</option>
                            <option value='Novel book'>Novel Book</option>
                            <option value='Poetry book'>Poetry Book</option>
                            <option value='History book'>History Book</option>
                            <option value='Psychology book'>Psychology Book</option>
                            <option value='Science book'>Science Book</option>
                            <option value='Cook book'>Cook Book</option>
                            <option value='Fables and folktales'>Fables and folktales</option>
                            <option value='Realistic literature'>Realistic literature</option>
                            <option value='Joke and riddle books'>Joke and riddle books</option>
                            <option value='Comics book'>Comics Book</option>
                            <option value='political book'>Political Book</option>

                        </select>

                        <select class='Price' name='drpdwnPrice' $btn_status required>
                            <option value=''>Price</option>
                            <option value='$17.99'>$17.99</option>
                            <option value='$15.99'>$15.99</option>
                            <option value='$10.90'>$10.90</option>
                        </select>

                        <button type='submit' name='btn_Submit' class='btn btn-outline-success' $btn_Submit >Save Record</button>

                        <button type='submit' name='btn_Create_new' class='btn btn-outline-primary' $btn_Create_New >Create New</button>


                        </fieldset>
                        </div>
                        </form>";}

    if ($editmode == "NewRecord"){

        $Book_no = $new_Book_no;

        echo "<form method='post'>

    <ul>
    <li><a class='active' href='#home'>Home</a></li>
    <li><a href='#news'>News</a></li>
    <li><a href='#contact'>Contact</a></li>
    <li style='float:right'><a href='#about'>About</a></li>
    </ul>

   <div class='divback'><p>Book Information</p></div>

    <input type='text' name='txt_Book_no' placeholder='Enter book no. e.g 101' maxlength='3' pattern='[0-4]{1,3}' title='Book number consist numbers only, letters are invalid' value='$new_Book_no' readonly>

    <input type='text' name='txt_Title_of_the_Book' placeholder='e.g Everyday' maxlength='40' patter='[a-z A-Z a-Z A-z ñ]{1,1}' title='Two book title are not allowed' $btn_status required>

    <input type='text' name='txt_Authors_name' placeholder='Enter the Authors Name' maxlength='40' pattern='[a-z A-Z a-Z A-z ñ]{1}' title=' The Authors name must be only one, two authors cant be accepted' $btn_status required>

  <select class='Country' name='drpdwnCountry' title='Input the right country of the book' $btn_status required>
                            <option value=''>Choose a Country</option>
                            <option value='australia'>Australia</option>
                            <option value='canada'>Canada</option>
                            <option value='usa'>USA</option>
                            <option value='korea'>Korea</option>
                            <option value='new york'> New York</option>
                            <option value='atlanta'> Atlanta</option>
                            <option value='netherlands'>Netherlands</option>
                        </select> 

   <select class='Genre' name='drpdwnGenre' title='Input the right genre of the book, don't leave this blank' $btn_status required>
                            <option value=''>Choose a Genre</option>
                            <option value='fantasy'>Fantasy</option>
                            <option value='fiction'>Fiction</option>
                            <option value='non-fiction'>Non-Fiction</option>
                            <option value='drama'>Drama</option>
                            <option value='satire'>Satire</option>
                            <option value='Romance'>Romance</option>
                            <option value='comedy'>Comedy</option>
                            <option value='Mystery/Thriller'>Mystery/Thriller</option>
                            <option value='Horror'> Horror</option>
                            <option value='Advenure and Action'> Advenure and Action</option>
                            <option value='Science fiction'>Science fiction</option>
                            <option value='Fairytale'>Fairytale</option>
                        </select> 


    <select class='Books' name='drpdwnTypes_of_book' title='Choose the right type of book for you, don't leave this blank' $btn_status required>
                            <option value=''>Choose a Book</option>
                            <option value='journal'>Journal</option>
                            <option value='Novel book'>Novel Book</option>
                            <option value='Poetry book'>Poetry Book</option>
                            <option value='History book'>History Book</option>
                            <option value='Psychology book'>Psychology Book</option>
                            <option value='Science book'>Science Book</option>
                            <option value='Cook book'>Cook Book</option>
                            <option value='Fables and folktales'>Fables and folktales</option>
                            <option value='Realistic literature'>Realistic literature</option>
                            <option value='Joke and riddle books'>Joke and riddle books</option>
                            <option value='Comics book'>Comics Book</option>
                            <option value='political book'>Political Book</option>

                        </select>

                        <select class='Price' name='drpdwnPrice' $btn_status required>
                            <option value=''>Price</option>
                            <option value='$17.99'>$17.99</option>
                            <option value='$15.99'>$15.99</option>
                            <option value='$10.90'>$10.90</option>
                        </select>

                        <input type='hidden' value='NewRecord' name='editmode'>
                       <button type='submit' name='btn_Submit' class='btn btn-outline-success' $btn_Submit >Save Record</button>

                        </fieldset>
                        </div>
                        </form>";}

    if ($editmode == "EDIT"){

        echo "<form method='post'>

    <ul>
    <li><a class='active' href='#home'>Home</a></li>
    <li><a href='#news'>News</a></li>
    <li><a href='#contact'>Contact</a></li>
    <li style='float:right'><a href='#about'>About</a></li>
    </ul>

    <div class='divback'><p>Book Information</p></div>

    <input type='text' name='txt_Book_no' placeholder='Enter book no. e.g 101' maxlength='3' pattern='[0-4]{1,3}' title='Book number consist numbers only, letters are invalid' value='".$Book_no."' readonly>

    <input type='text' name='txt_Title_of_the_Book' placeholder='e.g Everyday' maxlength='40' patter='[a-z A-Z a-Z A-z ñ]{1,1}' title='Two book title are not allowed' value='".$Title_of_the_Book."' required>

    <input type='text' name='txt_Authors_name' placeholder='Enter the Authors Name' maxlength='40' pattern='[a-z A-Z a-Z A-z ñ]{1}' title=' The Authors name must be only one, two authors cant be accepted' value='".$Authors_Name."' required>

  <select class='Country' name='drpdwnCountry' title='Input the right country of the book' required>
                            <option value='".$Country."'>".$Country."</option>
                            <option value='australia'>Australia</option>
                            <option value='canada'>Canada</option>
                            <option value='usa'>USA</option>
                            <option value='korea'>Korea</option>
                            <option value='new york'> New York</option>
                            <option value='atlanta'> Atlanta</option>
                            <option value='netherlands'>Netherlands</option>
                        </select> 

   <select class='Genre' name='drpdwnGenre' title='Input the right genre of the book, don't leave this blank' required>
                            <option value='".$Genre."'>".$Genre."</option>
                            <option value='fantasy'>Fantasy</option>
                            <option value='fiction'>Fiction</option>
                            <option value='non-fiction'>Non-Fiction</option>
                            <option value='drama'>Drama</option>
                            <option value='satire'>Satire</option>
                            <option value='Romance'>Romance</option>
                            <option value='comedy'>Comedy</option>
                            <option value='Mystery/Thriller'>Mystery/Thriller</option>
                            <option value='Horror'> Horror</option>
                            <option value='Advenure and Action'> Advenure and Action</option>
                            <option value='Science fiction'>Science fiction</option>
                            <option value='Fairytale'>Fairytale</option>
                        </select> 


    <select class='Books' name='drpdwnTypes_of_book' title='Choose the right type of book for you, don't leave this blank' required>
                            <option value='".$Types_of_Book."'>".$Types_of_Book."</option>
                            <option value='journal'>Journal</option>
                            <option value='Novel book'>Novel Book</option>
                            <option value='Poetry book'>Poetry Book</option>
                            <option value='History book'>History Book</option>
                            <option value='Psychology book'>Psychology Book</option>
                            <option value='Science book'>Science Book</option>
                            <option value='Cook book'>Cook Book</option>
                            <option value='Fables and folktales'>Fables and folktales</option>
                            <option value='Realistic literature'>Realistic literature</option>
                            <option value='Joke and riddle books'>Joke and riddle books</option>
                            <option value='Comics book'>Comics Book</option>
                            <option value='political book'>Political Book</option>

                        </select>

                        <select class='Price' name='drpdwnPrice' required>
                            <option value='".$Price."'>".$Price."</option>
                            <option value='$17.99'>$17.99</option>
                            <option value='$15.99'>$15.99</option>
                            <option value='$10.90'>$10.90</option>
                        </select>

                        <input type='hidden' value='EDIT' name='editmode'>
                         <button type='submit' name='btn_Submit' class='btn btn-success'>Save Record</button>

                    <a href = 'Purchase.php'>
                    <button type='button'  class='btn btn-secondary'>Cancel</button>

                    </a>
                      
                        </div>
                    </form>";}

    ?>

    <form method = "post">
        <table class='table table-hover' style='margin-left:10px'>

            <thead>
                <tr>

                    <td class='tdtable'><b> Book No.</b></td>
                    <td class='tdtable'><b> Title of the Book</b></td>
                    <td class='tdtable'><b> Author's Name</b></td>
                    <td class='tdtable'><b> Country</b></td>
                    <td class='tdtable'><b> Genre</b></td>
                    <td class='tdtable'><b> Type of Book</b></td>
                    <td class='tdtable'><b> Price</b></td>

                </tr>
            </thead>

            <?php

            $sql="Select * from bookinfo ";
            $ctr=0;
            foreach($PDO->query($sql) as $row){
                echo '<tr>';

                echo '<input type="hidden" name="hideBook_no['.$ctr.']" value='.$row['Book_no'].'>';
                echo '<td>'.$row['Book_no']. '</td>';
                echo '<td>'.$row['Title_of_the_Book']. '</td>';
                echo '<td>'.$row['Authors_Name']. '</td>';
                echo '<td>'.$row['Country']. '</td>';
                echo '<td>'.$row['Genre']. '</td>';
                echo '<td>'.$row['Types_of_Book']. '</td>';
                echo '<td>'.$row['Price']. '</td>';
                echo '<td>'.'<input class="btn btn-info" type="submit" name="btn_edit['.$ctr.']" value="Edit" '.$btn_status_one.' >'.'</td>';
                echo '<td>'.'<input class="btn btn-danger" type="submit" name="btndelete['.$ctr.']" value="Delete" '.$btn_status_one.' > '.'</td>';

                $ctr++;   
            }
            ?>
        </table>
    </form>
 </div>