<?php 

// echo "<br>";
// echo "ID : ".$id." Nom : ".$nom." Age : ".$age." ans";

if(!empty($allContacts))
{
    foreach($allContacts as $contact)
    {
        echo "<li>".$contact['first_Name'].' <a href="'.base_url("database/delete/".$contact['id']).'">X</a></li></br>';
    }
}

?>