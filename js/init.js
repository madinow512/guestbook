/**
 * Created by Markus on 09.11.2015.
 */
function initApplication() {
    registerResizeEvent();
    registerKeyEvents();
    registerMenuHoverEvent();
    registerLinkClickEvent();
    bindContentAreaClick();
    bindContextMenu();
    displayPage();
}
