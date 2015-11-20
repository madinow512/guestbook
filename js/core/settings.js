/**
 * Created by Markus on 16.11.2015.
 */
/**
 * URL to the backend REST interfaces
 * @type {string}
 */
var urlAPI = 'http://'+document.location.hostname+'/static/interfaces/' ;
/**
 * specifies whether we're currently in development mode
 * @type {boolean}
 */
var devModeEnabled = true;

/**
 * maximum amount of content loaded at once
 * @type {number}
 */
var contentLimit = 10 ;

/**
 * the offset for the content being loaded
 * @type {number}
 */
var contentOffset = 0 ;

/**
 * time of polling interval
 * @type {number}
 */
var pollingIntervalTime = 10000 ;
