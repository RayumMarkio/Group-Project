        $title=$_POST['title'];
        $date=$_POST['date'];
        $description=$_POST['description'];
        $journal=$mysqli->query("SELECT id FROM journal WHERE title='$title' AND date='$date' AND description='$description'") or die($mysqli->error);
        $row_id = mysqli_fetch_assoc($journal);
        $id=$row_id['id'];

        $destFile='upload/'.$_FILES['uploadedImage']['name'];
        $result=$mysqli->query("INSERT INTO image (image_url,journal_id) VALUES('$destFile','$id')") or die($mysqli->error);

        if(move_uploaded_file($_FILES['uploadedImage']['tmp_name'],$destFile)){
            header("Location: create.php?edit=".$id);
            $update=true;
            $result=$mysqli->query("SELECT * FROM journal WHERE id=$id") or die($mysqli->error());
            
            if (count(array($result))==1) {
                $row=$result->fetch_array();
                $title=$row['title'];
                $date=$row['date'];
                $description=$row['description'];
            }
        }
        else{
            echo "<script>alert('Can't Upload')</script>";
        }
        
    }

    



?>
