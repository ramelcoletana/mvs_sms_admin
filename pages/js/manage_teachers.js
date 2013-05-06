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
function searchTeacher(){
    var searchInput = $('#input_search').val();
    var teacher_type = $('#teacher_type').val();
    var pageL = $('#page_limit').val();
    var obj = {"search_input": searchInput, "teacher_type": teacher_type, "page_limit": pageL};
    $.ajax({
        type: 'POST',
        url: 'process/view_teacher_first_page.php',
        data: obj,
        success: function(response){
            console.log(data);
        }
    });

    pagination_sys(1);
}
//paginate
function pagination_sys(page){
    var obj = {"page": page};
    $.ajax({
       type: 'POST',
        url: 'process/paginate.php',
        data: obj,
        success: function(response){
            console.log(data);
        }
    });
}