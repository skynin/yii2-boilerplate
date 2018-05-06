define(
    [],
function( ) {
"use strict";

var $ = jQuery;

console.log('Start API');

var snApi = {idModule: 'snapi'};

snApi.endpoints = {
'foo-register': function(sendData) {
	console.log(sendData);

    return $.ajax({
        method: 'POST',
        url: '/sapi/foo-register',
        contentType : 'application/json',
        data: JSON.stringify(sendData)
    });
}};

return snApi;
});
