$(document).ready(function(){
    $.get("json/json_project_list.php",function(response){
        let project = $.parseJSON(response);
        console.log(project);
        let rows;
        let i=0;
        $.each(project,function(key,data){
            i++
            rows += 
            "<tr>"+
                "<td>"+i+"</td>"+
                "<td>"+data.school+"</td>"+
                "<td>"+data.project_name+"</td>"+
                "<td>"+data.student_id+"</td>"+
                "<td>"+data.teacher_id+"</td>"+
            "</tr>"
        });
        console.log(rows);
        $("tbody").html(rows);
    });
});
