<?php
    // Process loan book form.
    if(isset($_POST["loan-book"])){
        if(Books::loanBookbyID($_POST)){
            redirect("?bookloaned");
        }else{
            $message = "This book is already out on loan, feel free to add this to the waiting list.<br /><br />";
            $class = "red bold";	
        }
    }else if(isset($_POST["wait-list"])){
        if(Waiting::checkUserAlreadyWaiting($_GET['bookid'], $user->userid)){
            $message = "You already have this book in your waiting list.<br /><br />";
            $class = "red bold";
        }else{
            if(Books::waitingListByID($_POST)){
                redirect("?WaitingListAdded");
            }
        }
    }else{
        $message = "";
        $class = "";	
    }
    // End waiting list form.
    if(isLoggedIn()){
    echo outputMessage($message, $class);
    echo "<h1 style='font-size:22px;'>Available Books</h1>";
    $bookIDs = $book->getAllBookIDs();
    if(count($bookIDs) > 0){
    echo "<div class='datagrid'><table><thead><tr><th>Book Name</th><th>Book Type</th><th>Release Date</th></tr></thead>";
    echo "<tbody>";
    
        /* loop to list every book from the database using the Books(); class */
            foreach($bookIDs as $bookID){
                $book = new Books($bookID);
                /* Show books to staff members 30 days before students */
                if($user->typeid == 2 || ($user->typeid == 1 && strtotime("+30 days", strtotime($book->bookcreated)) < strtotime("now"))){
                                        echo "<tr>";
                                        echo "<td><a href='?bookid=" . $book->bookid . "'>";
                                        echo $book->bookname;
                                        echo "</a></td>";
                                        echo "<td>";
                                        echo $book->type;
                                        echo "</td>";
                                        echo "<td>";
                                        echo date("jS F, Y", strtotime($book->bookcreated));
                                        echo "</td>";
                                        echo "</tr>";
                }
            }
        echo "</tbody></table></div><br />";
    }else{
        echo "<p>There are no books!</p>";
    }
    
    $id = $_GET['bookid'];
    if(!isset($id) || $id > count($bookIDs) || $id <= 0 || !is_numeric($id)){        
            return false;
        }else{
            echo "<h1 style='font-size:22px;'>Book Information</h1>";
            $book = new Books($id);
            echo "<div class='datagrid'><table><thead><tr><th>Book Name</th><th>Book Type</th><th>Release Date</th><th>Loan</th><th>Waiting List</th></tr></thead>";
            echo "<tbody><tr>";
            echo "<td>";
            echo $book->bookname;
            echo "</td><td>";
            echo $book->type;
            echo "</td><td>";
            echo date("jS F, Y", strtotime($book->bookcreated));
            echo "</td><td>";
            if($book->typeid != 2){
            echo '<form name="loan" id="loan" action="" method="post">
                    <input type="hidden" id="bookid" name="bookid" value="' . $book->bookid . '" />
                    <input type="hidden" id="userid" name="userid" value="' . $user->userid . '" />
                    <input type="hidden" id="typeid" name="typeid" value="' . $book->typeid . '" />
                    <input type="hidden" id="returndate" name="returndate" value="' . date("Y-m-d H:i:s", strtotime("+1 week")) . '" />
                    <input type="submit" id="loan-book" name="loan-book" value="Loan" />
                  </form>';
            }else{
                echo "You're not able to loan reference books!";
            }
            echo "</td><td>";
            if($book->typeid != 2){
            echo '<form name="wait-list" id="wait-list" action="" method="post">
                    <input type="hidden" id="bookid" name="bookid" value="' . $book->bookid . '" />
                    <input type="hidden" id="userid" name="userid" value="' . $user->userid . '" />
                    <input type="submit" id="wait-list" name="wait-list" value="Waiting List Add" />
                  </form>';
            }else{
                    echo "You're not able to loan reference books!";
            }
            echo "</td>";
            echo "</tr></tbody></table></div><br />";
        }
    }