/**
 * Created by Markus on 16.11.2015.
 */
function PostInterface(){ }

PostInterface.execute = function(url, data, successCallback, errorCallback){
    $.ajax({
        url: url,
        method: 'post',
        data: data,
        async: true,
        dataType: 'json',
        success: function(sData){
            successCallback(sData);
        },
        error: function(eData){
            errorCallback(eData);
        }
    })
};