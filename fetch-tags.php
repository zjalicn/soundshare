<?php
    function fetch_tags(){
        require("connect-db.php");
        $tagsArray = array();
        $sql = "
        SELECT tags
        FROM sounds";
        if ($result = mysqli_query($mysqli, $sql)){ //populate the tags array
            while($row = mysqli_fetch_array($result)){
                foreach (explode(" ",$row['tags']) as $token){
                    if (!in_array($token, $tagsArray)) array_push($tagsArray, $token);
                }
            }
        }
        echo '<span id="tagsString" style="display:none">'.implode (" ", $tagsArray).'</span>';
        echo '<span id="searchTags" style="display:none" name="searchTags"></span>';
        $tagid=0;
        foreach ($tagsArray as $tag){
            echo '<span class="tagspan" id="tag'.$tagid.'" onClick="selectTag(\''.$tagid.'\')">⨯'.$tag.'</span>';
            $tagid++;
        }
    }
?>


