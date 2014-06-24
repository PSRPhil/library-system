<?php
    if(isLoggedIn()){
    include("phpinc/initialise.php");
    echo '<LINK href="css/stylesheet.css" rel="stylesheet" type="text/css">';
    
    $id = $_GET['bookid'];
    
    $allwaiting = $waiting->getBookWaitingIDs($id);
    if(count($allwaiting) > 0){
        echo "<h1 style='font-size:22px;'>Book Waiting List</h1>";
        $listcount = 0;
        function ordinal_suffix($listcount){
            if($listcount < 11 || $listcount > 13){
                switch($listcount % 10){
                    case 1: return 'st';
                    case 2: return 'nd';
                    case 3: return 'rd';
                }
            }
            return 'th';
        }
        echo "<div class='datagrid'><table><thead><tr><th>Position</th><th>Book Name</th><th>Waiting User</th><th>Waiting Date Added</th></tr></thead>";
        echo "<tbody>";

        foreach($allwaiting as $waitingid){
            $listcount++;
           
            $waiting = new Waiting($waitingid);
            $book = new Books($waiting->bookid);
            $user = new User($waiting->userid);
            $loaned = new Loaned($waiting->loanid);
            
            echo "<tr>";
            echo "<td>";
            echo $listcount . ordinal_suffix($listcount);
            echo "</td>";
            echo "<td><a href='?bookid=" . $book->bookid . "'>";
            echo $book->bookname;
            echo "</a></td>";
            echo "<td>";
            echo $user->username;
            echo "</td>";
            echo "<td>";
            echo date("jS F, Y", strtotime($waiting->dateadded));
            echo "</td>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody></table></div><br />";
    }else{
        return false;
    }
    
    $userWaiting = $waiting->getAllUserWaitingIDs($user->userid);
    if(count($userWaiting) > 0){
    echo "<h1 style='font-size:22px;'>Your Waiting List</h1>";
    
        echo "<div class='datagrid'><table><thead><tr><th>Book Name</th><th>Waiting User</th><th>Waiting Date Added</th></tr></thead>";
        echo "<tbody>";
        
        foreach($userWaiting as $userWaitingID){
            $waitingUser = new Waiting($userWaitingID);
            $book = new Books($waitingUser->bookid);
            $user = new User($waitingUser->userid);
            
            echo "<tr>";
                                            echo "<td><a href='?bookid=" . $book->bookid . "'>";
                                            echo $book->bookname;
                                            echo "</a></td>";
                                            echo "<td>";
                                            echo $user->username;
                                            echo "</td>";
                                            echo "<td>";
                                            echo date("jS F, Y", strtotime($waiting->dateadded));
                                            echo "</td>";
                                            echo "</td>";
                                            echo "</tr>";
        }
        echo "</tbody></table></div><br />";
    }else{
            return false;
        }
    }