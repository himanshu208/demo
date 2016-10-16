
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'connection.php';
        $select_db=mysql_query("SELECT * FROM student_db LEFT JOIN course_db"
                . " ON student_db.course_id=course_db.course_id INNER JOIN section_db"
                . " ON student_db.section_id=section_db.section_id WHERE course_name='PRE - NUS'");
        while ($data=mysql_fetch_array($select_db))
        {
            echo $data['section_name']."<br/>";    
        }
        
        
        ?>
    </body>
</html>
