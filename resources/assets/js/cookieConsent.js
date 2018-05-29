window.addEventListener("load", function(){
    window.cookieconsent.initialise({
        "palette": {
            "popup": {
            "background": "#84c443",
            "text": "#ffffff"
            },
            "button": {
            "background": "#efefef",
            "text": "#3D92B7"
            }
        },
        "content": {
            "message": "Vi använder cookies för att ge dig en bättre upplevelse av Akademiska Hus webb-app.",
            "dismiss": "Jag förstår!",
            "link": "Läs mer"
        },
        "theme": "classic",
        "position": "top",
        onPopupOpen : function () {pushDown(this.element.clientHeight);},
        onPopupClose : function () {pushDown(0);}
    });

    function pushDown(height) {
        var navbar = document.getElementsByClassName("akaNavTop")[0];
        var body = document.getElementsByTagName("body")[0];
        navbar.style.transition = 'all 1s';
        navbar.style.marginTop = height+'px';
        body.style.transition = 'all 1s';
        body.style.marginTop = height+'px';
    }
});
