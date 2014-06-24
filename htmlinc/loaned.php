<?php
    if(isLoggedIn()){
    include("phpinc/initialise.php");
    // Temp style echo
    echo '<LINK href="css/stylesheet.css" rel="stylesheet" type="text/css">';
    
    // Show full loaned out list to staff members
    if($user->typeid == 2){
        echo "<h1 style='font-size:22px;'>All loaned out books</h1>";
        $allLoaned = $loaned->getAllLoanedIDs();
        if(count($allLoaned) > 0){
        echo "<div class='datagrid'><table><thead><tr><th>Book Name</th><th>Loaning User</th><th>Loan Date</th><th>Return Date</th></tr></thead>";
        echo "<tbody>";

            /* loop to list every book from the database using the Books(); class */
                foreach($allLoaned as $loanedid){
                    $loaned = new Loaned($loanedid);
                    $book = new Books($loaned->bookid);
                    $user = new User($loaned->userid);
                                            echo "<tr>";
                                            echo "<td><a href='?bookid=" . $book->bookid . "'>";
                                            echo $book->bookname;
                                            echo "</a></td>";
                                            echo "<td>";
                                            echo $user->username;
                                            echo "</td>";
                                            echo "<td>";
                                            echo date("jS F, Y", strtotime($loaned->loandate));
                                            echo "</td>";
                                            echo "</td>";
                                            echo "<td>";
                                            echo date("jS F, Y", strtotime($loaned->returndate));
                                            echo "</td>";
                                            echo "</tr>";
                }
            echo "</tbody></table></div><br />";
        }else{
            echo "<p>There are no books out on loan!</p>";
        }
    }
    
    if(count($userLoaned) > 0){
    echo "<h1 style='font-size:22px;'>Your loaned out books</h1>";
    $userLoaned = $loaned->getAllUserLoanedIDs();
        echo "<div class='datagrid'><table><thead><tr><th>Book Name</th><th>Loaning User</th><th>Loan Date</th><th>Return Date</th></tr></thead>";
        echo "<tbody>";
        
        foreach($userLoaned as $userLoanID){
            $userLoaned = new Loaned($userLoanID);
            $book = new Books($userLoaned->bookid);
            $user = new User($userLoaned->userid);
            
            echo "<tr>";
                                            echo "<td><a href='?bookid=" . $book->bookid . "'>";
                                            echo $book->bookname;
                                            echo "</a></td>";
                                            echo "<td>";
                                            echo $user->username;
                                            echo "</td>";
                                            echo "<td>";
                                            echo date("jS F, Y", strtotime($userLoaned->loandate));
                                            echo "</td>";
                                            echo "</td>";
                                            echo "<td>";
                                            echo date("jS F, Y", strtotime($userLoaned->returndate));
                                            echo "</td>";
                                            echo "</tr>";
        }
        echo "</tbody></table></div><br />";
    }
    }