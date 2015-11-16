/**
 * Created by Markus on 11.11.2015.
 */
function checkValues(valueArr){
    var result = {correct: true};
    $.each(valueArr, function(index, value){
        result[index] = (value && value.replace(/\s/g,"").length > 0) ;
        result.correct &= result[index] ;
    });
    return result ;
}