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
 * specifies whether content is being loaded for the first time
 * @type {boolean}
 */
var contentInitialLoad = false ;

/**
 * time of polling interval
 * @type {number}
 */
var pollingIntervalTime = 10000 ;

/**
 * interval for asynchronously loading private content
 * @type
 */
var privatePollInterval ;

/**
 * interval for asynchronously loading public content
 * @type
 */
var publicPollInterval;

/**
 * specifying whether content is prepended or appended
 * @type {boolean}
 */
var prependContent = true ;

/**
 * previous value when scrolling up / down
 * @type {number}
 */
var prevScrollValue = 0 ;

/**
 * an array containing german month names
 * @type {string[]}
 */
var monthNames = [
    "Januar", "Februar", "März",
    "April", "Mai", "Juni", "Juli",
    "August", "September", "Oktober",
    "November", "Dezember"
];