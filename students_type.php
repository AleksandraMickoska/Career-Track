<?php
    function getStudentTypes()
    {
        $db = mysqli_connect("localhost","id16124386_brainsterlabs",'o?X\6-nnD<FHI<Lt',"id16124386_brainster_labs");
        $db->set_charset('utf8');
        $query = "SELECT * FROM studenttype LIMIT 20";
        $result = mysqli_query($db,$query);
           
        while($row = mysqli_fetch_array($result))
        {
            echo '
            <option class = "text-dark bg-white fw-bold" value="'.$row['Type'].'">'.$row['Type'].'</option>';   
        }
    }
?>