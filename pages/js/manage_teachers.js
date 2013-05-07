/**
 * Created with JetBrains PhpStorm.
 * User: student1
 * Date: 5/6/13
 * Time: 11:02 AM
 * To change this template use File | Settings | File Templates.
 */
$(function(){

    //page limit
    $('#page_limit').keyup(function(){
        pageLimitKeyup();
    });
    $('#page_limit').blur(function(){
        pageLimitBlur();
    });

    //pagination
    pagination_system(1);

    $('#input_search').keyup(function(){
        pagination_system(1);
    });

    $('#btn_search').click(function(){
        pagination_system(1);
    });

    //check and uncheck checkboxes
    $('#tbdy_teachers').on('click','tr', function(){
        var tr_id = this.id;
        var cell = document.getElementById(tr_id).getElementsByTagName('td');
        var checkbox = cell[0].getElementsByTagName('input')[0];
        if(checkbox.checked == true){
            checkbox.checked = false;
        }else{
            checkbox.checked = true;
        }

    });
    $("#tbdy_teachers").on('click','input[type=checkbox]', function(){
        console.log(this.id);
        var checkbox = input[type=checkbox];
        if(checkbox.checked == false){
            checkbox.checked = true;
        }else{
            checkbox.checked = false;
        }

        //unresolved checking checkbox
    });

    //check all
    $('#check_all_teachers').click(function(){
        var tbdy = document.getElementById('tbdy_teachers');
        var tr = tbdy.getElementsByTagName('tr');
        for(var ctr = 0; ctr < tr.length; ctr++){
            var td = tr[ctr].getElementsByTagName('td')[0];
            var checkbox = td.getElementsByTagName('input')[0];

            if(checkbox.checked == false){
                checkbox.checked = true;
            }
        }
    });
    //uncheck all
    $('#un_check_all_teachers').click(function(){
        var tbdy = document.getElementById('tbdy_teachers');
        var tr = tbdy.getElementsByTagName('tr');
        for(var ctr = 0; ctr < tr.length; ctr++){
            var td = tr[ctr].getElementsByTagName('td')[0];
            var checkbox = td.getElementsByTagName('input')[0];

            if(checkbox.checked == true){
                checkbox.checked = false;
            }
        }
    });

    //delete several
    $('#delete_several_teachers').click(function(){
       delete_several_teachers();
    });

});

/*F U N  C T I O N S*/

//PAGE LIMIT
function pageLimitKeyup(){
    var pageLimit = $('#page_limit').val();
    var regex = /^[0-9]$/;
    var pL = pageLimit.length;
    var maxP = 5;
    var maxL = 1;
    if(!regex.test(pageLimit)){
        var res = pageLimit.substring(0,pL-1);
        $('#page_limit').val(res);
    }
    if(pL > maxL ){
        var res = 1;
        $('#page_limit').val(res);
    }
    if(pageLimit > 5){
        var res = 5;
        $('#page_limit').val(res);
    }


}
function pageLimitBlur(){
    var pageLimit = $('#page_limit').val();
    if(pageLimit === "" || pageLimit === NaN || pageLimit === null){
       var res = 5;
        $('#page_limit').val(res);
    }

}

function view_teachers_paginate(page){
    var searchInput = $('#input_search').val();
    var teacher_type = $('#teacher_type').val();
    var pageL = $('#page_limit').val();
    var obj = {"search_input": searchInput, "teacher_type": teacher_type, "page_limit": pageL, "page": page};
    $.ajax({
        type: 'POST',
        url: 'process/view_teachers_paginate.php',
        data: obj,
        success: function(response){
            $('#tbdy_teachers').html(response);
            //console.log(response);
        },
        error: function(response){
            console.log("error in viewing first page - "+JSON.stringify(response));
        }
    });
}
//paginate
function pagination_system(page){
    var input_search_val = $('#input_search').val();
    var obj = {"page": page, "input_search_val": input_search_val, "teacher_type": $('#teacher_type').val(), "page_limit": $('#page_limit').val()};
    $.ajax({
       type: 'POST',
        url: 'process/pagination_system.php',
        data: obj,
        success: function(response){
            //console.log(response);
            $('#pagination_displayer').html(response);
            view_teachers_paginate(page);
        }
    });
}

//check_checkbox
/*function check_checkbox(id){

    var checkbox = $('#checkbox'+id).attr('checked','checked');
    checkbox.attr('checked', 'checked');
    console.log(checkbox);
    if(checkbox.checked == false){

        checkbox.attr('checked', 'checked');
    }else{
        //checkbox.checked = true;
        checkbox.removeAttr('checked');

    }
}*/
//delete one teacher
function delete_one_teacher(id){
    var c = confirm("Delete this teacher..\n\nAre you sure");
    var obj = { "teach_auto_id": id };
    if(c){
        $.ajax({
            type: 'POST',
            url: 'process/delete_one_teacher.php',
            data: obj,
            success: function(response){
                console.log(response);
                view_teachers_paginate(1)
            },
            error: function(response){
                console.log("error in deleting teacher -- "+JSON.stringify(response));
            }
        });
    }
}

//delete several teachers
function delete_several_teachers(){
    var tbdy = document.getElementById('tbdy_teachers');
    var tr = tbdy.getElementsByTagName('tr');
    var dataArr = new Array();
    for(var ctr = 0; ctr < tr.length; ctr++){
        var td = tr[ctr].getElementsByTagName('td')[0];
        var checkbox = td.getElementsByTagName('input')[0];
        if(checkbox.checked == true){
            var td2 = tr[ctr].getElementsByTagName('input');
            var teacher_id = td2[1].value;
            dataArr.push(teacher_id);
        }
    }
    if(dataArr.length < 1){
        $('#tbl_teachers_warning').addClass('n_warning');
        $('.tbl_warning_msg').html("No rows selected.");
    }else{
        var c = confirm("Deleting teachers...\n\nContinue anyway?");
        if(c){
            $('#tbl_teachers_warning').removeClass('n_warning');
            $('.tbl_warning_msg').html("");
            var obj = { "dataArr" : dataArr };
            $.ajax({
                type: 'POST',
                url: 'process/delete_several_teachers.php',
                data: obj,
                success: function(response){
                    console.log(response);
                    view_teachers_paginate(1);
                },
                error: function(response){
                    console.log("error in deleting several teachers -- "+JSON.stringify(response));
                }
            });
        }
    }
}