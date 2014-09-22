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
    
}

/*
 Listener function for the red button. Changes color to  red.
*/
function useRed() {

}

/*
 Listener funciton for white button. Changes color to white.
*/
function useWhite() {

}

/*
 Listener function for 'clear' button. Clears all faces.
*/
function clearAll() {

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
};

//TODO: init game and other functions to interact with html
function initGame(){
    var game = GameRunner();
}

//Game controll
function GameRunner() {


    var canvas = document.getElementById("gameArea");
    canvas.getContext("2d").clearRect(0,0,canvas.width,canvas.height);
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
    

        //basically if there is an x, y pair where they are
        //both less than, 
        this.containsPoint = function(x, y, color, canvas) {
            for(var i=  0; i<this.points.length; ++i) {
                var sign = 1;
                for(var j=0; j<this.points.length; ++j) {
                    if(j == i)
                        continue;
                    var ij = Subtract(j, i);
                    var ip = Subtract(Point(x, y), i);
                    sign *= Cross(ij, pj);
                }
                if(sign < 0) {
                    return false;
                }
            }
            return true;
        };

        this.renderFace = function(canvas) {
            if (canvas && this.points) {
                if (this.points.length >= 3) {
                    var context = canvas.getContext("2d");
                    context.save();
                    context.beginPath();
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
        return this;
    }

    //init mouse events

    //init board by random seed
    var num_points = rand(2,3);

    var points_list = genPointList(canvas.width,canvas.height,num_points);

    for(i=0; i < points_list.length; i++){
        graphFaces.push(graphFace(points_list[i],"#FFF"));
    }

    for (var i = graphFaces.length - 1; i >= 0; i--) {
        graphFaces[i].renderFace(canvas);
    };
}