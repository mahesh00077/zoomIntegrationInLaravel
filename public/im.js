function isSupportWebsocket() {
    return 'WebSocket' in window || 'MozWebSocket' in window;
}