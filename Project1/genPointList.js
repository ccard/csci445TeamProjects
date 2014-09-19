/*
	Generates at least three points to feed planer.js function graphFace.
	graphFace requires a pointlist with at least three points and a color, in hex.
	/*
      point object = {x:<xval>, y:<val>}
      pointlist point objects and has at least three points

      color is expected to to be a hex number i.e. #0f00ff
          

      TODO: Use " var relativeSize" and  "sizeVariance()" to produce shapes that are
      relativly the same size.

      TODO: deal with the crossing lines.

    */


// TODO: learn how to use closures, whack the global variables
var maxX;  //canvas dimensions used globally 
var maxY;

var maxPoints = 2; // including 0, add 1 to this number
var relativeSize = 2;  // scales down the shape, smaller number gives bigger shape

var localTest = false;  // for drawing on a test canvas

function genPointList(width,height,nump) {  
	//var canvas = document.getElementById("canvas");
	//canvas.addEventListener("mousedown", getPosition, false);

	var points_ret = []; //array of arrays with 3 points
	do {  //do loop cycles through sets of points until a good set is made
		var prePoint = [];		//holds presorted list of points
		var prePoint1 = [];
		var sortedPoint = [];	//sorted by X
		var polyPoint = [];  	//sorted by Polygon shape
		var numPoints;			//random number of points to make

		maxX = width;  //canvas dimensions. 
		maxY = height;		

		numPoints = numPointsToMake();
		
		// generate an unsorted list of points
		for (i=0; i <= nump; i++) {
			prePoint.push(new Point(randX(),randY()));	
		}

		// sort the points in three steps
		sortedPoint = prePoint.slice(0);  	//for now, keep an orginal copy of the points in prePoint
		sortedPoint.sort(sortPoints);//sortedPoint becomes the working list. "sortPoints" is a local function.
		polyPoint = polySort(sortedPoint);   // local function

		points_ret.push(polyPoint);

	} while(badGeometry(polyPoint));

	// show the array of points. 
	//testPoints(sortedPoint);  //use a sort-By-X list
	//testPoints(polyPoint);		// use a poly-sorted list 
	return points_ret;

// --------- Helper functions ------------
} 

function Point(x, y) {
	this.x = x;
	this.y = y;
}

// random number generator that all the functions use
function rand(min, max) {
	return Math.floor(Math.random()*(max-min+1)+min);
}

//decide how many points to generate: 3 to 6 points
function numPointsToMake() {
	var min=2;  // including 0, this is one more point than what min says.
	return rand(min,maxPoints);
}



//generate a random X
function randX() {
	var min = 0 + 10; //stay away from the edge
	var max = (maxX - 10)/relativeSize;
	return rand(min, max);

}

function randY() {
	var min = 0 + 10; //stay away from the edge
	var max = (maxY - 10)/relativeSize;
	return rand(min, max);

}

// generate a random color. Source: http://stackoverflow.com/questions/1484506/random-color-generator-in-javascript 
function randColor() {
	var letters = '0123456789ABCDEF'.split('');
	var color = '#';
	for (var i = 0; i < 6; i++ ) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;

}

//http://stackoverflow.com/questions/1129216/sorting-objects-in-an-array-by-a-field-value-in-javascript
function sortPoints(a,b) {
	if (a.x < b.x)
		return -1;
	if (a.x > b.x)
		return 1;
	return 0;
}

function polySort(inList) {
	//TODO: still got some line crosses
	// issues: not solving for multiple minX and multiple maxX
	
	var tempList = inList.slice(0);   //clone a working copy
	
	var pointMinX, pointMaxX;
	var pointMinY, pointMaxY;
	var polyPt = [];    			//output array

	//find pointMinX
	pointMinX = tempList[0].x;
	pointMaxX = tempList[tempList.length-1].x

	// we know point 0 is root, so pop it to the poly sort list.
	// TODO: it might be better to use a middle X point.
	polyPt.push(new Point(tempList[0].x, tempList[0].y));
	tempList.splice(0,1); //pop point 0

	// move along x, look for Y <= point0.y, until maxX is reached
	for (var index =0, l = tempList.length; index < l; index++){
		if(tempList[index].y <= polyPt[0].y){
			polyPt.push(new Point(tempList[index].x, tempList[index].y));
		}
	}

	// Now move left, look for Y > point0.y, until at head of list
	//alert("tempList.length-1: " + ((tempList.length)-1));
	for(var index = ((tempList.length)-1);  index >= 0; index--) {

		if(tempList[index].y > polyPt[0].y) {
			polyPt.push(new Point(tempList[index].x, tempList[index].y));
		}
	}

	return polyPt;
}

function badGeometry(points) {
	
	var r1; var r2; var r3;
	var good = false;
	var x0=points[0].x; var y0=points[0].y;
	var x1=points[1].x; var y1=points[1].y;
	var x2=points[2].x; var y2=points[2].y;

	var lenOne   = Math.sqrt(    Math.pow( ( x1 - x0 ), 2 ) + Math.pow( ( y1 - y0 ), 2 )   );
	var lenTwo   = Math.sqrt(    Math.pow( ( x2 - x1 ), 2 ) + Math.pow( ( y2 - y1 ), 2 )   );
	var lenThree = Math.sqrt(    Math.pow( ( x0 - x2 ), 2 ) + Math.pow( ( y0 - y2 ), 2 )   );
//if lenOne,  and lenTwo  and lenThree are within 50% of each other 
	r1 = lenOne / lenTwo;
	r2 = lenTwo / lenThree;
	r3 = lenThree / lenOne;
if(       (r1 > .5) && (r1 < 2) && (r2 > .5) && (r2 < 2) && (r3 > .5) && (r3 < 2)                              ) {
	return true;
}

//alert(" Line Length  1: " + lenOne.toFixed(0) + ", \n\r Line Length  2: " + lenTwo.toFixed(0) + ", \n\r Line Length  3; " + lenThree.toFixed(0) + ",\n\r Acceptable set?  " + good);

	return false;

}

function clearCanvas(context) {
  context.clearRect(0, 0, canvas.width, canvas.height);
}   

function morethings() {  //have not tried these functions yet

	ctx.rotate(radians*Math.PI/180);
	ctx.translate(70,70);
}

// draw points and info on the screen to see how they look.
function testPoints(point, polyPoint) {
	if(localTest) {
		
		if(canvas.getContext)
		{
			
			var ctx = canvas.getContext("2d");

			clearCanvas(ctx, canvas);
			// Draw shape
			ctx.fillStyle=randColor();  
			ctx.lineWidth=6; 
			ctx.strokeStyle="#FFFFFF"; //color of all lines
			ctx.beginPath();

			// Draw the first point of the shape
			ctx.moveTo(point[0].x,point[0].y); 

			for(i = 1; i < point.length ; i++) {
			
				ctx.lineTo(point[i].x,point[i].y);				
			}


			ctx.closePath();
			ctx.fill();
			ctx.stroke();  //draw outline

			//show point numbers
			ctx.fillStyle="#FFFFFF"; 
			//https://developer.mozilla.org/en-US/docs/Drawing_text_using_a_canvas#fillText%28%29

			ctx.font = "20pt Arial"
			for(i = 0; i < point.length; i++) {
				ctx.fillText("Point " + (i +1) + " x: " + point[i].x + ", y: " + point[i].y, 500, (i + 1) * 50);			

			}

			//draw a scale in white
			ctx.moveTo(10,10);
			ctx.lineTo(10,700);
			ctx.lineTo(770,700);
			ctx.lineWidth=1;
			ctx.stroke();

			ctx.fillText("0,0", 20, 20);
			ctx.fillText("0,700", 20, 700);
			ctx.fillText("770,700", 650, 700);	

			document.getElementById("status").innerHTML = "Was a cross detected?"
		}
	}


// end of local test	

}

// // eventhandlers
// canvas.addEventListener("mousedown", getPosition, false);

// function getPosition(event) {

//   var x = event.x;
//   var y = event.y;

//    x -= canvas.offsetLeft;
//   y -= canvas.offsetTop;

//   alert("x:" + x + " y:" + y);

// }


