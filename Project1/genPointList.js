/*
	Generates at least three points to feed planer.js function graphFace.
	graphFace requires a pointlist with at least three points and a color, in hex.
	/*
      point object = {x:<xval>, y:<val>}
      pointlist point objects and has at least three points
 
    */

var maxX;  //canvas dimensions used globally 
var maxY;

var localTest = false;  // for drawing on a test canvas

// called from Team16F14.js: genPointList(canvas.width,canvas.height,num_points_per_shape, num_shapes,);
// 
function genPointList(width,height, numShapes) { 

	if(localTest) {
		var canvas = document.getElementById("canvas");
	}
	
	maxX = width;  			//canvas dimensions. 
	maxY = height;

	var points_ret = []; 	//array of shapes to return to gsmr
	var oneShape= [];  		//holds three points of a triangle
	var startRow;
	var scaler = 15;
	 var iShape = 0;		//passed to local tester to give shape number



	// g2 is The Grid. Rules: each row is a shape with p1x, p1y, p2x, p2y, p3x,p3y.
	// each new row must contain at least two points from the row above it to use 
	// as the connecting edge. the first two points are the connecting edge, and the 
	// last point is the new edge.
	var g2=[[10,10, 12,7, 8,7],	
			[10,10, 12,7, 14,10],
			[14,10, 12,7, 15,6],
			[10,10, 14,10, 12,14],
			[12,14, 10,10, 6,14],
			[6,14, 10,10, 8,11],
			[8,11, 10,10, 8,7 ],
			[8,11, 8,7, 4,5 ],
			[8,11, 4,5, 5,11 ],
			[6,14, 8,11, 5,11 ],
		];				 

		// pick a random number for a start row. Max is (numRows - numShapes)
		startRow = rand(0, g2.length-numShapes-1);
	
	 for(iRow = startRow; iRow < startRow + numShapes ; iRow++) {
		oneShape.push(new Point(g2[iRow][0] * scaler,g2[iRow][1] * scaler));
		oneShape.push(new Point(g2[iRow][2] * scaler,g2[iRow][3] * scaler));
		oneShape.push(new Point(g2[iRow][4] * scaler,g2[iRow][5] * scaler));
		points_ret.push(oneShape.slice(0));
		iShape++;
		oneShape.length = 0; 			//clear the array
	}


	if(localTest) {
			// show the array of points. 
		for(iTest = 0; iTest <= iShape; iTest++) {
			testPoints(points_ret[iTest], iTest);
		}
	}

	return points_ret;

} 

function CrossZ(a, b) {
    //var x = a.x*b.z - a.z*b.y;
    //var y = -a.x*b.z + b.x*a.z;
    var z = a.x*b.y - b.x*a.y;
    return z;
	//return Math.sqrt(x*x + y*y + z*z);
}

/*
 return a-b. so you get the vector ba.
*/
function Subtract(a, b) {
	var x = a.x - b.x;
	var y= a.y - b.y;
	return new Point(x, y);
}

// --------- Helper functions ------------

function Point(x, y) {
	this.x = x;
	this.y = y;
}

function rand(min, max) {
	return Math.floor(Math.random()*(max-min+1)+min);
}


function clearCanvas(context) {
  context.clearRect(0, 0, canvas.width, canvas.height);
}   


//////////////////////// Functions below this line are for local drawing tests /////////////////////////
// draw points and info on the screen to see how they look.
// generate a random color. Source: http://stackoverflow.com/questions/1484506/random-color-generator-in-javascript 
function randColor() {
	var letters = '0123456789ABCDEF'.split('');
	var color = '#';
	for (var i = 0; i < 6; i++ ) {
		color += letters[Math.floor(Math.random() * 16)];
	}
	return color;

}

// main test draw function
function testPoints(point, shapeNumber) {
	if(localTest) {
		
		if(canvas.getContext)
		{
			
			var ctx = canvas.getContext("2d");
			var thisColor = randColor();
			var textColumn = canvas.width - 150;
			var textRow;
			var sn = shapeNumber * 4;   //text location adjustment
			var xLoc = canvas.width / 4;  // shape location ajustment
			var yLoc = canvas.height / 4;

			//clearCanvas(ctx, canvas);

			// Draw shape
			ctx.fillStyle=thisColor;
			ctx.lineWidth=3; 
			ctx.strokeStyle="#FFFFFF"; //color of all lines

			ctx.beginPath();

			// Draw the first point of the shape
			ctx.moveTo(xLoc + point[0].x, yLoc + point[0].y); 

			for(i = 1; i < point.length ; i++) {  //draw the other two points
			
				ctx.lineTo(xLoc + point[i].x, yLoc + point[i].y);				
			}


			ctx.closePath();
			ctx.fill();
			ctx.stroke();  //draw outline

			ctx.fillStyle=thisColor; 
			//https://developer.mozilla.org/en-US/docs/Drawing_text_using_a_canvas#fillText%28%29

			ctx.font = "8pt Arial"
			for(var i = 0; i < point.length; i++) {
				//ctx.fillText("Point " + (i +1) + " x: " + point[i].x + ", y: " + point[i].y, textColumn, (i + 1) * (shapeNumber*20));			
				ctx.fillText("Shape " + shapeNumber + ", Point " + (i +1) + " x: " + point[i].x + ", y: " + point[i].y, textColumn, (sn + i + 1) * 20);			

			}

			//draw a scale in white
			ctx.fillStyle="#FFFFFF"; 
			ctx.moveTo(5,5);
			ctx.lineTo(5,canvas.height - 2);
			ctx.lineTo(canvas.width, canvas.height - 2);
			ctx.lineWidth=1;
			ctx.stroke();

			ctx.fillText("0,0", 20, 20);
			ctx.fillText("0, " + canvas.height, 20, canvas.height - 5);
			ctx.fillText(canvas.width + ", " + canvas.height, canvas.width-120, canvas.height - 5);	

			document.getElementById("status").innerHTML = "Test Screen"
		}
	}


// end of local test	

}



