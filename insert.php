<?php
         $con = mysql_connect("sql107.byethost8.com","b8_15951173","Vankayala123");
         if (!$con)
           {
             die('Could not connect: ' . mysql_error());
           }

           mysql_select_db("b8_15951173_test_user", $con);


          $user=$_REQUEST['KEY_USER'];
          $email=$_REQUEST['KEY_EMAIL'];
          $password=$_REQUEST['KEY_PASSWORD'];
          $mobile=$_REQUEST['KEY_MOBILE'];		  
		  		  			
              if($user==NULL || $email==NULL || $password==NULL || $mobile==NULL)
             {


                $r["re"]="Fill the all fields!!!";
                print(json_encode($r));
                //die('Could not connect: ' . mysql_error());
             }


            else
          {		   
		   $sql="select * from user where Mobile='".$mobile."' or Email='".$email."'";
		   
           $i=mysql_query($sql,$con);
		   
		   $num_rows=mysql_num_rows($i);

		   if($num_rows==0)
                  {
                        $q="INSERT INTO  user(UserName,Email,Password,Mobile) values('".$user."','".$email."','".$password."','".$mobile."')";                        
						$s= mysql_query($q,$con); 
                        if(!$s)
                          {
                                $r["re"]="Inserting problem in database";                  
                               print(json_encode($r));
                          }
                         else
                          {
                             $r["re"]="Record inserted successfully";
                              print(json_encode($r));
                          }
                 }
            else
             {
               $r["re"]="Record is repeated";
                 print(json_encode($r));
              } 
  }
 mysql_close($con);
               
    ?> 