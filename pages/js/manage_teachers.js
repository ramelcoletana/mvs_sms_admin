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

    $('#btn_search').click(function(){
       //view_teacher_first_page();
        pagination_system(1);
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
        var res = 1;
        $('#page_limit').val(res);
    }


}
function pageLimitBlur(){
    var pageLimit = $('#page_limit').val();
    if(pageLimit === "" || pageLimit === NaN || pageLimit === null){
       var res = 1;
        $('#page_limit').val(res);
    }

}

//SEACRH
/*function view_teacher_first_page(){
    var searchInput = $('#input_search').val();
    var teacher_type = $('#teacher_type').val();
    var pageL = $('#page_limit').val();
    var obj = {"search_input": searchInput, "teacher_type": teacher_type, "page_limit": pageL};
    $.ajax({
        type: 'POST',
        url: 'process/view_teacher_first_page.php',
        data: obj,
        success: function(response){
            $('#tbdy_teachers').html(response);
        },
        error: function(response){
            console.log("error in viewing first page - "+JSON.stringify(response));
        }
    });

}*/
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