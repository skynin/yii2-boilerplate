define(
    ['sncore', 'snrepository'],
function( snCore, snRepo ) {
"use strict";

console.log('Start APP');

var thisModule = {idModule: 'app'};

snCore.riotMount(thisModule);

/*
setTimeout(() => {
snCore.showAlert({
	message: 'Test message',
	alertType: 'danger',
	dismiss: true
})
}, 1000);
*/

return thisModule;
});