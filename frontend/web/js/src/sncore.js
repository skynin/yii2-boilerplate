define(
    ['snapi'],
function( snApi ) {
"use strict";

var $ = jQuery;

console.log('Start Core');

var snCore = {
	showAlert: function(args) {
		snCore.trigger('bootstrap-alert', args);
	},

	sendData: function(sendName, sendData) {
		return snApi.endpoints[sendName](sendData);
	}
};

if (window.riot) {
/* * * Riot dispatcher * * */

   window.riot.observable(snCore);

	snCore.riotMount = function(application) {

		if (application) {
			window.riot.observable(application);
			window.riot.application = application;
		}

		if (snCore.riotag) return;

		window.riot.tag('raw', '<span></span>', function(opts) {
			this.root.innerHTML = opts.content
			this.on('update', () => { if (this.root.innerHTML != opts.content) this.root.innerHTML = opts.content })
  		});

		window.riot.compile(function() {
			snCore.riotag = window.riot.mount('*');
		});
	};
}

return snCore;

});