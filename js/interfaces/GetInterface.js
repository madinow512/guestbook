/**
 * Created by Markus on 16.11.2015.
 */
/**
 * Created by Markus on 16.11.2015.
 */
function GetInterface(){ }

GetInterface.execute = function(url, data, successCallback, errorCallback){
    $.ajax({
        url: url,
        method: 'get',
        data: data,
        async: true,
        dataType: 'json',
        beforeSend: function (request) {
            request.setRequestHeader("Access-Control-Allow-Origin", "*");
            request.setRequestHeader("Access-Control-Allow-Credentials", "true");
            request.setRequestHeader("Access-Control-Allow-Methods", "GET,PUT,POST,DELETE,OPTIONS");
            request.setRequestHeader("Access-Control-Allow-Headers", "Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
        },
        success: function(sData){
            successCallback(sData);
        },
        error: function(eData){
            errorCallback(eData);
        }
    })
};