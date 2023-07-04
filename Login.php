<?php
require 'Database.php';
$PDO = Database::letsconnect();

$editmode = "oldrecord";

//Generating Primary Key
$new_Costumer_no = "";
$btn_Create_New = "";
$btn_status = "disabled";
$btn_Submit = "disabled";
$btn_status_one = "";

if (isset($_POST['btn_Create_new'])){


    $btn_Create_New = 'disabled';
    $btn_status = "";
    $btn_Submit = "";
    $btn_status_one = "disabled";


    $sql= "select Costumer_no from costumerinfo order by Costumer_no";

    foreach ($PDO->query($sql) as $row){

        $last_Costumer_no = $row['Costumer_no'];
        $num_Costumer_no=(int)(substr($last_Costumer_no, -3))+1;
        $new_Costumer_no = sprintf('%04d',$num_Costumer_no);
    }

    $editmode = "NewRecord";

}


//-------

if(isset($_POST['btn_Submit'])){

    $editmode = $_POST['editmode'];

    $Costumer_no = $_POST['Costumer_no'];
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Age = $_POST['Age'];
    $Barangay = $_POST['Barangay'];
    $City = $_POST['City'];
    $Province = $_POST['Province'];
    $Email_Address = $_POST['Email_Address'];
    $Contact_no = $_POST['Contact_no'];
    $Telephone_no = $_POST['Telephone_no'];

    if ($editmode == "NewRecord"){ 

        $PDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "insert into costumerinfo values(?,?,?,?,?,?,?,?,?,?);";
        $q = $PDO->prepare($sql);
        $q->execute(array($Costumer_no, $FirstName,  $LastName, $Age, $Barangay, $City, $Province, $Email_Address, $Contact_no, $Telephone_no));
    }

    else{
        $PDO -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        $sql = "update costumerinfo set Costumer_no=?, FirstName=?, LastName=?, Age=?, Barangay=?, City=?, Province=?, Email_Address=?, Contact_no=?, Telephone_no=?  where Costumer_no=?";
        $q = $PDO ->prepare($sql);
        $q->execute(array($Costumer_no, $FirstName,  $LastName, $Age, $Barangay, $City, $Province, $Email_Address, $Contact_no, $Telephone_no, $Costumer_no));
    }

    $editmode = "oldrecord"; 
}

if(isset($_POST['btn_edit'])) {
    $editmode = "EDIT";
    $index = key($_POST['btn_edit']);
    $array_Costumer_no = $_POST['hideCostumer_no'];
    $Costumer_no = $array_Costumer_no[$index];
    $sql = "select * from costumerinfo where Costumer_no = '".$Costumer_no."'";
    $q = $PDO -> prepare($sql);
    $q -> execute(array($Costumer_no));
    $data = $q -> fetch(PDO::FETCH_ASSOC);
    $Costumer_no = $data['Costumer_no'];
    $FirstName = $data['FirstName'];
    $LastName = $data['LastName'];
    $Age = $data['Age'];
    $Barangay = $data['Barangay'];
    $City = $data['City'];
    $Province = $data ['Province'];
    $Email_Address = $data ['Email_Address'];
    $Contact_no = $data ['Contact_no'];
    $Telephone_no = $data ['Telephone_no'];


    $editmode = "EDIT";
    $btn_status_one = "disabled";
}

if (isset($_POST['btndelete'])) {
    $index=key($_POST['btndelete']);
    $array_Costumer_no=$_POST['hideCostumer_no'];
    $Costumer_no = $array_Costumer_no[$index];
    $sql = "delete from costumerinfo where Costumer_no='".$Costumer_no."'";
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
    <body>   
        <style type="text/css">         

            .divback {
                margin-top: 20px;
                background-color:ghostwhite; 
                width: 350px;
                height: 50px;
                margin-left: 30px;
                font-family: fantasy;
                font-size: 30px;
                text-align: center;

            }
            
            body {
            background-size:1566px 800px;
            background-repeat:no-repeat;
            
        }

            /*Table*/

            .table-hover {
                margin-top: 80px;
                width: 1350px;
                font-family: fantasy;
                padding: 12px 10px;
            }

            .tdtable {
                background-color:lightslategray; 
                text-align:center; 
                font-size:18px;  
            }
            
            .table-bordered {
                width: 1250px;
                
            }

            /*Button*/

            .btn-outline-success {
                margin-left: 32px;
                height: 50px;
                color: black;
                font-size: 17px;
                font-family: fantasy; 
            }

            .btn-outline-secondary {
                margin-left: 10px;
                height: 50px;
                width: 350px;
                color: black;
                font-size: 17px;
                font-family: fantasy;
            }

            .btn-outline-primary {
                margin-left: 15px;
                height: 50px;
                color: black;
                font-size: 17px;
                font-family: fantasy;
            }

            input[type=text], select {
                width: 350px;
                padding: 15px 20px;
                margin-top: 60px;
                margin-left: 30px;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=number] {
                width: 350px;
                padding: 15px 20px;
                margin-left: 32px;
                margin-top: 30px;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=Email] {
                width: 350px;
                padding: 15px 20px;
                margin-left: 40px;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            .Barangay {
                width: 350px;
                height: 50px;
                padding: 0px 20px;
                margin-left: 30px;
                margin-top: 10px;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .City {
                width: 350px;
                height: 50px;
                padding: 0px 20px;
                margin-left: 38px;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;

            }

            .Province {
                width: 350px;
                height: 50px;
                padding: 0px 20px;
                margin-left: 34px;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;

            }

            select {
                width: 350px;
                padding: 12px 20px;
                margin: -10px;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            input[type=button]{
                width: 100px;
                background-color: #4CAF50;
                color: white;
                padding: 12px 10px;
                margin-left: 30px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit] {
                width: 100px;
                background-color: #4CAF50;
                color: white;
                padding: 12px 10px;
                margin-left: 33px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }


            input[type=submit]:hover {
                background-color: #45a049;
            }



            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
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
    <body background ="cc1.jpg">

        <?php
        if ($editmode == "oldrecord"){

            echo "<form method='post'>  

            <ul>
                <li><a class='active' href='#home'>Home</a></li>
                <li><a href='#news'>News</a></li>
                <li><a href='#contact'>Contact</a></li>
                <li style='float:right'><a href='bookHTML.html'>Go Back To Homepage</a></li>
            </ul>


            <div class='divback'><p>Costumer Information</p></div>

                <input type='text' name='Costumer_no' placeholder='Enter Costumer no. e.g 101' maxlength='3' pattern='[0-4]{1,3}' title='Book number consist numbers only, letters are invalid' value='".$new_Costumer_no."' readonly>

                <input type='text' name='FirstName' placeholder='Enter your First Name' pattern='[A-z a-Z ñ]' title='Enter your name, numbers are not included'". $btn_status." required>

                <input type='text' name='LastName' placeholder='Enter your Last Name' pattern='[A-z a-Z ñ]' title='Enter your last name, numbers are not included'". $btn_status." required>

                <input type='number' name='Age' placeholder='Enter your Age' pattern='[1-3]' title='Do not leave it unanswered, letters are not allowed'". $btn_status." required>



                 <select class='Barangay' name='Barangay' title='Do not leave this blank' ".$btn_status." required>
                    <option value=''>Choose a Barangay</option>
                    <option value='Abella'>Abella</option>
                    <option value='Bagumbayan Norte'>Bagumbayan Norte</option>
                    <option value='Bagumbayan Sur'>Bagumbayan Sur</option>
                    <option value='Balatas'>Balatas</option>
                    <option value='Calauag'>Calauag</option>
                    <option value='Cararayan'>Cararayan</option>
                    <option value='Carolina'>Carolina</option>
                    <option value='Concepcion Grande'>Concepcion Grande</option>
                    <option value='Concepcion Pequeña'>Concepcion Pequeña</option>
                    <option value='Dayangdang'>Dayangdang</option>
                    <option value='Del Rosario'>Del Rosario</option>
                    <option value='Dinaga'>Dinaga</option>
                    <option value='Igualdad Interior'>Igualdad Interior</option>
                    <option value='Lerma'>Lerma</option>
                    <option value='Liboton'>Liboton</option>

                </select> 


                <select class='City' name='City' title='Do not leave this blank'". $btn_status." required>
                    <option value=''>Choose a City</option>
                    <option value='Antipolo City'>Antipolo City</option>
                    <option value='Batangas City'>Batangas City</option>
                    <option value='Cebu City'>Cebu City</option>
                    <option value='Davao City'>Davao City</option>
                    <option value='Iriga'>Iriga</option>
                    <option value='Legazpi'>Legazpi</option>
                    <option value='Masbate City'>Masbate City</option>
                    <option value='Naga City'>Naga City</option>
                    <option value='Quezon City'>Quezon City</option>
                    <option value='Sorsogon City'>Sorsogon City</option>
                    <option value='Vigan'>Vigan</option>

                </select> 


                <select class='Province' name='Province' title='Do not leave this blank' ". $btn_status." required>
                    <option value=''>Choose a Province</option>
                    <option value='Albay'>Albay</option>
                    <option value='Batangas'>Batangas</option>
                    <option value='Camarines Sur'>Camarines Sur</option>
                    <option value='Cebu'>Cebu</option>
                    <option value='Masbate'>Masbate</option>
                    <option value='Quezon'>Quezon</option>
                    <option value='Sorsogon'>Sorsogon</option>
                    <option value='Ilocos Sur'>Ilocos Sur</option>
                    <option value=''></option>
                </select>


                    <input type='email' name='Email_Address' placeholder='e.g.,Angelinediaz90@gmail.com' title='Input the your correct email address' ". $btn_status." required>

                    <input type='number' name='Contact_no' placeholder='e.g., 09123456789' pattern='[0] {1} [9] {1} [0-9] {9}' title='Numbers only, letters are not valid' ". $btn_status." required>

                    <input type='number' name='Telephone_no' placeholder='e.g., 475-899-110' pattern='[0-9] {3} [-] {1} [0-9] {3} [-] {1} [0-9] {3}' title='Numbers only, letters are not valid' ". $btn_status." required>
<input type='hidden' value='NewRecord' name='editmode'>

                    <input type = 'submit' name = 'btn_Submit' class='btn btn-outline-success' ".$btn_Submit.">

                    <input type='submit' name='btn_Create_new' class='btn btn-outline-primary' value='Create New' ".$btn_Create_New.">

        </div>
    </form>";

        }

        if ($editmode == "NewRecord"){

            $Costumer_no = $new_Costumer_no;

            echo "<form method='post'>  

            <ul>
                <li><a class='active' href='#home'>Home</a></li>
                <li><a href='#news'>News</a></li>
                <li><a href='#contact'>Contact</a></li>
                <li style='float:right'><a href='#about'>About</a></li>
            </ul>


            <div class='divback'><p>Costumer Information</p></div>

                <input type='text' name='Costumer_no'  maxlength='3' pattern='[0-4]{1,3}' title='Book number consist numbers only, letters are invalid' value='$new_Costumer_no'readonly>

                <input type='text' name='FirstName' placeholder='Enter your First Name' pattern='[A-z a-Z ñ]' title='Enter your name, numbers are not included' ".$btn_status." required>

                <input type='text' name='LastName' placeholder='Enter your Last Name' pattern='[A-z a-Z ñ]' title='Enter your last name, numbers are not included' ".$btn_status." required>

                <input type='number' name='Age' placeholder='Enter your Age' pattern='[1-3]' title='Do not leave it unanswered, letters are not allowed' ".$btn_status." required>



                 <select class='Barangay' name='Barangay' title='Do not leave this blank' ".$btn_status." required>
                    <option value=''>Choose a Barangay</option>
                    <option value='Abella'>Abella</option>
                    <option value='Bagumbayan Norte'>Bagumbayan Norte</option>
                    <option value='Bagumbayan Sur'>Bagumbayan Sur</option>
                    <option value='Balatas'>Balatas</option>
                    <option value='Calauag'>Calauag</option>
                    <option value='Cararayan'>Cararayan</option>
                    <option value='Carolina'>Carolina</option>
                    <option value='Concepcion Grande'>Concepcion Grande</option>
                    <option value='Concepcion Pequeña'>Concepcion Pequeña</option>
                    <option value='Dayangdang'>Dayangdang</option>
                    <option value='Del Rosario'>Del Rosario</option>
                    <option value='Dinaga'>Dinaga</option>
                    <option value='Igualdad Interior'>Igualdad Interior</option>
                    <option value='Lerma'>Lerma</option>
                    <option value='Liboton'>Liboton</option>

                </select> 


                <select class='City' name='City' title='Do not leave this blank' ".$btn_status." required>
                    <option value=''>Choose a City</option>
                    <option value='Antipolo City'>Antipolo City</option>
                    <option value='Batangas City'>Batangas City</option>
                    <option value='Cebu City'>Cebu City</option>
                    <option value='Davao City'>Davao City</option>
                    <option value='Iriga'>Iriga</option>
                    <option value='Legazpi'>Legazpi</option>
                    <option value='Masbate City'>Masbate City</option>
                    <option value='Naga City'>Naga City</option>
                    <option value='Quezon City'>Quezon City</option>
                    <option value='Sorsogon City'>Sorsogon City</option>
                    <option value='Vigan'>Vigan</option>

                </select> 


                <select class='Province' name='Province' title='Do not leave this blank' ".$btn_status." required>
                    <option value=''>Choose a Province</option>
                    <option value='Albay'>Albay</option>
                    <option value='Batangas'>Batangas</option>
                    <option value='Camarines Sur'>Camarines Sur</option>
                    <option value='Cebu'>Cebu</option>
                    <option value='Masbate'>Masbate</option>
                    <option value='Quezon'>Quezon</option>
                    <option value='Sorsogon'>Sorsogon</option>
                    <option value='Ilocos Sur'>Ilocos Sur</option>
                    <option value=''></option>
                </select>


                    <input type='email' name='Email_Address' placeholder='e.g.,Angelinediaz90@gmail.com'  title='Input the your correct email address' ".$btn_status." required>

                    <input type='number' name='Contact_no' placeholder='e.g., 09123456789' pattern='[0] {1} [9] {1} [0-9] {9}' title='Numbers only, letters are not valid' ".$btn_status." required>

                    <input type='number' name='Telephone_no' placeholder='e.g., 475-899-110' pattern='[0-9] {3} [-] {1} [0-9] {3} [-] {1} [0-9] {3}' title='Numbers only, letters are not valid' ".$btn_status." required>

<input type='hidden' value='NewRecord' name='editmode'>
                      <input type='submit' name='btn_Submit' class='btn btn-outline-success' value='Save Record' $btn_Submit>
                      
  <a href = 'error.php'>
                       <input type='button'  class='btn btn-secondary' value='Cancel'>

                    </a>

        </div>
    </form>";

        }


        if ($editmode == "EDIT"){

            echo "<form method='post'>  

            <ul>
                <li><a class='active' href='#home'>Home</a></li>
                <li><a href='#news'>News</a></li>
                <li><a href='#contact'>Contact</a></li>
                <li style='float:right'><a href='#about'>About</a></li>
            </ul>


            <div class='divback'><p>Costumer Information</p></div>

                <input type='text' name='Costumer_no' placeholder='Enter book no. e.g 101' maxlength='3' pattern='[0-4]{1,3}' title='Book number consist numbers only, letters are invalid' value='".$Costumer_no."' readonly>

                <input type='text' name='FirstName' placeholder='Enter your First Name' pattern='[A-z a-Z ñ]' title='Enter your name, numbers are not included' value='".$FirstName."' required>

                <input type='text' name='LastName' placeholder='Enter your Last Name' pattern='[A-z a-Z ñ]' title='Enter your last name, numbers are not included' value='".$LastName."' required>

                <input type='number' name='Age' placeholder='Enter your Age' pattern='[1-3]' title='Do not leave it unanswered, letters are not allowed' value='".$Age."' required>



                 <select class='Barangay' name='Barangay' title='Do not leave this blank' required>
                    <option value='".$Barangay."'>".$Barangay."</option>
                    <option value='Abella'>Abella</option>
                    <option value='Bagumbayan Norte'>Bagumbayan Norte</option>
                    <option value='Bagumbayan Sur'>Bagumbayan Sur</option>
                    <option value='Balatas'>Balatas</option>
                    <option value='Calauag'>Calauag</option>
                    <option value='Cararayan'>Cararayan</option>
                    <option value='Carolina'>Carolina</option>
                    <option value='Concepcion Grande'>Concepcion Grande</option>
                    <option value='Concepcion Pequeña'>Concepcion Pequeña</option>
                    <option value='Dayangdang'>Dayangdang</option>
                    <option value='Del Rosario'>Del Rosario</option>
                    <option value='Dinaga'>Dinaga</option>
                    <option value='Igualdad Interior'>Igualdad Interior</option>
                    <option value='Lerma'>Lerma</option>
                    <option value='Liboton'>Liboton</option>

                </select> 


                <select class='City' name='City' title='Do not leave this blank' required>
                    <option value='".$City."'>".$City."</option>
                    <option value='Antipolo City'>Antipolo City</option>
                    <option value='Batangas City'>Batangas City</option>
                    <option value='Cebu City'>Cebu City</option>
                    <option value='Davao City'>Davao City</option>
                    <option value='Iriga'>Iriga</option>
                    <option value='Legazpi'>Legazpi</option>
                    <option value='Masbate City'>Masbate City</option>
                    <option value='Naga City'>Naga City</option>
                    <option value='Quezon City'>Quezon City</option>
                    <option value='Sorsogon City'>Sorsogon City</option>
                    <option value='Vigan'>Vigan</option>

                </select> 


                <select class='Province' name='Province' title='Do not leave this blank' required>
                    <option value='".$Province."'>".$Province."</option>
                    <option value='Albay'>Albay</option>
                    <option value='Batangas'>Batangas</option>
                    <option value='Camarines Sur'>Camarines Sur</option>
                    <option value='Cebu'>Cebu</option>
                    <option value='Masbate'>Masbate</option>
                    <option value='Quezon'>Quezon</option>
                    <option value='Sorsogon'>Sorsogon</option>
                    <option value='Ilocos Sur'>Ilocos Sur</option>
                    <option value=''></option>
                </select>

                    <input type='email' name='Email_Address' placeholder='e.g.,Angelinediaz90@gmail.com' title='Input the your correct email address' value='".$Email_Address."' required>

                    <input type='number' name='Contact_no' placeholder='e.g., 09123456789' pattern='[0] {1} [9] {1} [0-9] {9}' title='Numbers only, letters are not valid' value='".$Contact_no."' required>

                    <input type='number' name='Telephone_no' placeholder='e.g., 475-899-110' pattern='[0-9] {3} [-] {1} [0-9] {3} [-] {1} [0-9] {3}' title='Numbers only, letters are not valid' value='".$Telephone_no."' required>

                    <input type='hidden' value='EDIT' name='editmode'>

                        <input type='submit' name='btn_Submit' class='btn btn-success' value='Save Record'>

                    <a href = 'Login.php'>
                       <input type='button'  class='btn btn-secondary' value='Cancel'>

                    </a>

                        </div>
                        </form>";
        }


        ?>

        <form method="post">
           <div class= "table-responsive-sm">
                            <table class='table table-hover' style='margin-left:10px'>

                <thead>
                    <tr>

                        <td class='tdtable'><b> Costumer No.</b></td>
                        <td class='tdtable'><b> First Name</b></td>
                        <td class='tdtable'><b> Last Name</b></td>
                        <td class='tdtable'><b> Age</b></td>
                        <td class='tdtable'><b> Barangay</b></td>
                        <td class='tdtable'><b> City</b></td>
                        <td class='tdtable'><b> Province</b></td>
                        <td class='tdtable'><b> Email Address</b></td>
                        <td class='tdtable'><b> Contact No.</b></td>
                        <td class='tdtable'><b> Telephone No.</b></td>


                    </tr>
                </thead>

                <?php


                $sql="Select * from costumerinfo ";
                $ctr=0;
                foreach($PDO->query($sql) as $row){
                    echo '<tr>';

                    echo '<input type="hidden" name="hideCostumer_no['.$ctr.']" value='.$row['Costumer_no'].'>';
                    echo '<td>'.$row['Costumer_no']. '</td>';
                    echo '<td>'.$row['FirstName']. '</td>';
                    echo '<td>'.$row['LastName']. '</td>';
                    echo '<td>'.$row['Age']. '</td>';
                    echo '<td>'.$row['Barangay']. '</td>';
                    echo '<td>'.$row['City']. '</td>';
                    echo '<td>'.$row['Province']. '</td>';
                    echo '<td>'.$row['Email_Address']. '</td>';
                    echo '<td>'.$row['Contact_no']. '</td>';
                    echo '<td>'.$row['Telephone_no']. '</td>';
                    echo '<td>'.'<input type="submit" name="btn_edit['.$ctr.']" value="Edit" '.$btn_status_one.'>'.'</td>';
                    echo '<td>'.'<input type="submit" name="btndelete['.$ctr.']" value="Delete"'.$btn_status_one.' >'.'</td>';

                    $ctr++;

                }
                               
                ?>
                
            </table>
        </form>

        </div>
    </body>
</html>
