function animateGame() {
    var gameDiv = document.getElementById('gamePage');
    var aboutDiv = document.getElementById('aboutPage');
    var aboutStyle = window.getComputedStyle(aboutDiv, null);
    var gameStyle = window.getComputedStyle(gameDiv, null);
    if (aboutStyle.visibility == "visible") {
        aboutDiv.classList.toggle('classShow');
        aboutDiv.classList.toggle('classHide');
    }
    if (gameStyle.visibility == "hidden") {
        gameDiv.classList.toggle('classHide');
        gameDiv.classList.toggle('classShow');
    }
}

function animateAbout() {
    var gameDiv = document.getElementById('gamePage');
    var aboutDiv = document.getElementById('aboutPage');
    var aboutStyle = window.getComputedStyle(aboutDiv, null);
    var gameStyle = window.getComputedStyle(gameDiv, null);
    if (gameStyle.visibility == "visible") {
        gameDiv.classList.toggle('classShow');
        gameDiv.classList.toggle('classHide');
    }
    if (aboutStyle.visibility == "hidden") {
        aboutDiv.classList.toggle('classHide');
        aboutDiv.classList.toggle('classShow');
    }
}

window.onload = function(){
    document.getElementById("mainContainer").classList.toggle('preload');
    document.getElementById("mainContainer").classList.toggle('postload');
};

//TODO: init game and other functions to interact with html


//Game controll
function GameRunner() {

    var canvas = document.getElementById("gameArea");
    var graphFaces = [];

    //TODO: functions for submit and clearing 


    function graphFace(pointList, color) {

        /*
      point object = {x:<xval>, y:<val>}
      pointlist point objects and has at least three points

      color is expected to to be a hex number i.e. #0f00ff
    */
        this.c = color;
        this.points = pointList;

        this.containsPoint = function(x, y, color, canvas) {
            // TODO: check if point is in a polygon
        };

        this.renderFace = function(canvas) {
            if (canvas && this.points) {
                if (this.points.length >= 3) {
                    var context = canvas.getContext("2d");
                    context.save();
                    cotext.beginPath();
                    context.fillStyle = this.c;
                    context.lineWidth = 2;
                    context.strokeStyle = "#000";
                    for (var i = this.points.length - 1; i >= 0; i--) {
                        context.moveTo(this.points[i].x, this.points[i].y);
                        if (i === 0) {
                            context.lineTo(this.points[this.points.length - 1].x, this.points[this.points.length - 1].y);
                        } else {
                            context.lineTo(this.points[i - 1].x, this.points[i - 1].y);
                        }
                    }

                    context.stroke();
                    context.fill();
                    context.closePath();

                    context.fillStyle = "#000";
                    for (var i = this.points.length - 1; i >= 0; i--) {
                        context.beginPath();
                        context.arc(this.points[i].x, this.points[i].y, 2, 0, 2 * Math.PI);
                        context.stroke();
                        context.fill();
                        context.closePath();
                    }

                    context.restore();
                }
            }
        };
    }

    //init mouse events

    //init board by random seed

}