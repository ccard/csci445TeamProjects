/*
    This function hides the about page and shows the game page
    by triggering transitions when a class is added and removed.
*/
function animateGame() {
    var gameDiv = document.getElementById('gamePage');
    var aboutDiv = document.getElementById('aboutPage');
    //The styles in the css file are computed so this is how the code
    //retrives those styles
    var aboutStyle = window.getComputedStyle(aboutDiv, null);
    var gameStyle = window.getComputedStyle(gameDiv, null);
    if (aboutStyle.visibility == "visible") {
        aboutDiv.classList.toggle('classShow');
        aboutDiv.classList.toggle('classHide');
    }
    if (gameStyle.visibility == "hidden") {
        gameDiv.classList.toggle('classHide');
        gameDiv.classList.toggle('classShow'); //This triggers the transition that shows the gamepage
    }
}

/*
 get the x, y offset of an html element.
 Source: http://stackoverflow.com/questions/442404/retrieve-the-position-x-y-of-an-html-element
*/
function getOffset( el ) {
    var _x = 0;
    var _y = 0;
    while( el && !isNaN( el.offsetLeft ) && !isNaN( el.offsetTop ) ) {
        _x += el.offsetLeft - el.scrollLeft;
        _y += el.offsetTop - el.scrollTop;
        el = el.offsetParent;
    }
    return { top: _y, left: _x };
}
/*
    This functions hides the game page and shows the about page
    by triggering transitions when a class is changed
*/
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


/*
  Listener function for the blue button. Changes the current color to blue.
*/
function useBlue() {
    window.game.setFaceColor("#0000FF");
}

/*
 Listener function for the red button. Changes color to  red.
*/
function useRed() {
    window.game.setFaceColor("#FF0000");
}

/*
 Listener funciton for white button. Changes color to white.
*/
function useWhite() {
    window.game.setFaceColor("#FFFFFF");
}

/*
 Listener function for 'clear' button. Clears all faces.
*/
function clearAll() {
    window.game.clear();
}

/*
 Listener function for 'new game' button. Makes a new game. 
*/
function newGame() {

}
/*
    This binds the DOMs onload function to our own load function
    that is called after the page is loaded by the browser
*/
window.onload = function(){
    document.getElementById("mainContainer").classList.toggle('preload');
    document.getElementById("mainContainer").classList.toggle('postload');
}

//TODO: init game and other functions to interact with html
function initGame(){
    window.game = GameRunner();
}

//Game controll
function GameRunner() {

    var canvas = document.getElementById("gameArea");

    canvas.getContext("2d").clearRect(0,0,canvas.width,canvas.height);
    var graphFaces = [];
    //TODO: functions for submit and clearing 
    this.faceColor = "#FFFFFF";
    this.setFaceColor = function(newColor) {
        this.faceColor = newColor; 
    }
    function graphFace(pointList, color) {

        /*
      point object = {x:<xval>, y:<val>}
      pointlist point objects and has at least three points

      color is expected to to be a hex number i.e. #0f00ff
       */
        this.c = color;
        this.points = pointList;

        //basically if there is an x, y pair where they are
        //both less than, 
        this.containsPoint = function(x, y) {
            //alert('this.points: ' + this.points);
            var p = new Point(x, y);
            for(var i=0; i<this.points.length; ++i) {
                var ijFirst = true;
                var sign = 0;
                var ip = Subtract(p, this.points[i]);

                for(var j=0; j<this.points.length; ++j) {
                    if(j === i)
                        continue;
                    var ij = Subtract(this.points[j], this.points[i]);

                    // alert('x, y: ' + x + ', ' + y);
                    // alert('j : ' + this.points[j].x + ', ' + this.points[j].y);

                    //alert('ip: ' + ip.x + ', ' + ip.y);
                    if(ijFirst) {
                        var crossValue = CrossZ(ij, ip);
                    } else {
                        var crossValue = CrossZ(ip, ij);
                    }
                    ijFirst = !ijFirst;
                    if(sign == 0) {
                        // alert(' ij: ' + ij.x + ', ' + ij.y + ' ' + ij.z + ' ip: ' + ip.x + ', ' + ip.y + ', ' + ip.z + ' cross: ' + Cross(ij, ip));
                        var sign = crossValue; 
                    } else {
                        // alert('sign: ' + sign + ' cross: ' + crossValue);
                        if( (sign <0 && crossValue > 0) || (sign > 0 && crossValue < 0) ) {
                            return false;
                        }
                    }

                }
/*                if( (sign < 0 && signAccum > 0) || (sign > 0 && signAccum < 0)) {
                    return false;
                }*/
            }
            return true;
        };

        this.renderFace = function(canvas, color) {
            this.c = color;
            if (canvas && this.points) {
                if (this.points.length >= 3) {
                    var context = canvas.getContext("2d");
                    context.save();
                    context.beginPath();
                    context.fillStyle = color;
                    context.lineWidth = 2;
                    context.strokeStyle = "#000";
                    context.moveTo(this.points[0].x, this.points[0].y);
                    for (var i = 1; i < this.points.length; ++i) {
                        context.lineTo(this.points[i].x, this.points[i].y);

                     /*   if (i === 0) {
                            context.lineTo(this.points[this.points.length - 1].x, this.points[this.points.length - 1].y);
                        } else {
                            context.lineTo(this.points[i - 1].x, this.points[i - 1].y);
                        }*/
                    }
                    context.closePath();
                    context.stroke();
                    context.fill();
                    //context.closePath();


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
        return this;
    };
    this.clear = function() {
        this.faceColor = "#FFF";
        for(var i=0; i<graphFaces.length; ++i) {
            graphFaces[i].renderFace(canvas, this.faceColor);
        }

    }

    this.handleClick = function(event) {
        var canvas = document.getElementById("gameArea");
        var canvasOffset = getOffset(canvas);
        var eventX = event.clientX;
        var eventY = event.clientY;
        //alert('client x,y: ' + eventX + ' ' + eventY);
        var finalX = eventX - canvasOffset.left;
        var finalY = eventY - canvasOffset.top;
        //alert('final x, y: ' + finalX + ' ' + finalY);
        for(var i=0; i<graphFaces.length; ++i) {
            if(graphFaces[i].containsPoint(finalX, finalY)) {
                graphFaces[i].renderFace(canvas, window.game.faceColor);
            } 
        }
    }
    //init mouse events
    canvas.addEventListener('click', this.handleClick);

    //init board by random seed
    var num_points = 3;//rand(2,3);

    var points_list = genPointList(canvas.width,canvas.height,num_points);

    for(i=0; i < points_list.length; i++){
        graphFaces.push(new graphFace(points_list[i],"#FFF"));
    }

    for (var i = graphFaces.length - 1; i >= 0; i--) {
        graphFaces[i].renderFace(canvas, this.faceColor);
    }
    return this;
}