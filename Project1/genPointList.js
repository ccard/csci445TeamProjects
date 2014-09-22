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
onload=genPointList;

var maxX = 500;  //canvas dimensions. Figure out how to get these from the HTML page.
var maxY = 500;
var maxPoints = 3; // including 0, this is really 4 points

// 
var relativeSize=maxX/5;  // edges will be about this long in relation to maxX

var localTest = true;

function genPointList() {  
	var canvas = document.getElementById("canvas");


	var prePoint = [];		//holds presorted list of points
	var sortedPoint = [];
	var numPoints;			//random number of points to make		

	numPoints = numPointsToMake();
	
	// generate an unsorted list of points
	for (i=0; i <= numPoints; i++) {
		prePoint.push(new Point(randX(),randY()));	
	}
	
	sortedPoint = prePoint;  			//for now, keep an orginal copy of the points in prePoint
	sortedPoint.sort(sortPoints);		//sortedPoint becomes the working list
	
	// test the array of points. 
	testPoints(sortedPoint);


// --------- Helper functions ------------
} 

function Cross(a, b) {
    var x = a.x*b.z - a.z*b.y;
    var y = -a.x*b.z + b.x*a.z;
    var z = a.x*b.y - b.x*a.y;
	return Point(x, y, z);
}

/*
 return a-b. so you get the vector ba.
*/
function Subtract(a, b) {
	var x = a.x - b.x;
	var y= a.y - b.y;
	var z = a.z - b.z;
	return Point(x, y, z);

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

// randomly adjust the size of the shapes, plus or minus 10 pixels
function sizeVariance() {
	var max=10,min=-10;
	return rand(min,max);
}

//generate a random X
function randX() {
	var min = 0 + 10; //stay away from the edge
	var max = maxX - 10;
	return rand(min, max);

}

function randY() {
	var min = 0 + 10; //stay away from the edge
	var max = maxY - 10;
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

// draw points and info on the screen to see how they look.
function testPoints(point) {
	if(localTest) {
		if(canvas.getContext)
		{
			var ctx = canvas.getContext("2d");

			// Draw shape
			ctx.fillStyle=randColor();  
			ctx.lineWidth=6; 
			ctx.strokeStyle="#000000"; //color of all lines
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
			ctx.fillStyle="#000000"; 
			//https://developer.mozilla.org/en-US/docs/Drawing_text_using_a_canvas#fillText%28%29
			ctx.font = "20pt Arial"
			for(i = 0; i < point.length; i++) {
				ctx.fillText("Point " + (i +1) + " x: " + point[i].x + ", y: " + point[i].y, 500, (i + 1) * 50);			

			}

			//draw a scale in black
			ctx.moveTo(10,10);
			ctx.lineTo(10,700);
			ctx.lineTo(770,700);
			ctx.lineWidth=1;
			ctx.stroke();

			ctx.fillText("0,0", 20, 20);
			ctx.fillText("0,700", 20, 700);
			ctx.fillText("770,700", 650, 700);		
		}
	}
// end of local test	

}



