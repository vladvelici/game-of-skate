var currentXCoord=0;
var currentYCoord=0;

var containerDiv = "#inputSkateTrick";
var container = $(containerDiv);
var $status = $('#status');

container.bind("contextmenu",function(e){ return false; });

var xMax=parseInt(container.css('width'));
var yMax=parseInt(container.css('height'));

var yPositionChange = Math.round(yMax/2);


var positions=[1];
positions[1] = "normal";
positions[2] = "fakie";
positions[3] = "nollie";
positions[4] = "switch";

var shoe=[1];
shoe[1]=$('#popfoot1');
shoe[2]=$('#popfoot2');
shoe[3]=$('#frontfoot1');
shoe[4]=$('#frontfoot2');

shoe[1].css('display','block');

if (trickEdit==false) {
	var currentShoe=1;
	var moveTheShoe=true;
	var currentPosition=1;
	var sw=false;
} else {
	var moveTheShoe=false;
	var currentPosition=$("#Trick_trick_default_stance").attr("value");
	var sw=(currentPosition<3 ? false : true);
	var currentShoe;

	for (i=1;i<=4;i++) {
		shoe[i].css('display','block');
		currentShoe=i;
		mx=$("#Trick_trick_"+(i>2 ? "front" : "pop")+"foot_left"+(i%2==0 ? "2" : "")).attr("value");
		my=$("#Trick_trick_"+(i>2 ? "front" : "pop")+"foot_top"+(i%2==0 ? "2" : "")).attr("value");
		moveShoe(mx,my);
	}
/*
	shoe[1].css('top',$("#Trick_trick_popfoot_top").attr("value")+'px');
	shoe[1].css('left',$("#Trick_trick_popfoot_left").attr("value")+'px');
	shoe[2].css('top',$("#Trick_trick_popfoot_top2").attr("value")+'px');
	shoe[2].css('left',$("#Trick_trick_popfoot_left2").attr("value")+'px');

	shoe[3].css('top',$("#Trick_trick_frontfoot_top").attr("value")+'px');
	shoe[3].css('left',$("#Trick_trick_frontfoot_left").attr("value")+'px');
	shoe[4].css('top',$("#Trick_trick_frontfoot_top2").attr("value")+'px');
	shoe[4].css('left',$("#Trick_trick_frontfoot_left2").attr("value")+'px');
*/
}

container.mousemove(function(e){
	if (moveTheShoe) {
		currentXCoord = e.pageX - this.offsetLeft;
		currentYCoord = e.pageY - this.offsetTop;
		moveShoe(currentXCoord,currentYCoord);
	}
});

container.mousedown(function(e) {
	if (e.which==1) {
		nextShoe();
	} else {
		toggleSw();
	}
});

container.mouseup(function(e){
	if (e.which==1) {
		nextShoe();
	}
});



function toggleSw() {
	if (sw) {
		sw=false;
	} else {
		sw=true;
	}
	moveShoe(currentXCoord,currentYCoord);
}

function moveShoe(x,y) {
	var renderX, renderY;
	if (currentShoe == 1 && y >= yPositionChange) {
		if (sw) {
			if (currentPosition!=4) {
				currentPosition = 4;
				renderCurrentFoot();
			}
		} else {
			if (currentPosition!=1) {
				currentPosition = 1;
				renderCurrentFoot();
			}
		}
		$status.html(positions[currentPosition]);
	} else if (currentShoe == 1 && y <= yPositionChange) {
		if (sw) {
			if (currentPosition!=3) {
				currentPosition = 3;
				renderCurrentFoot();
			}
		} else {
			if (currentPosition!=2) {
				currentPosition = 2;
				renderCurrentFoot();
			}
		}
		$status.html(positions[currentPosition]);
	}
	if (currentShoe==1 || currentShoe==3) {
		if (currentPosition==1) {
			renderY=y-20;
			renderX=x-17;
		} else if (currentPosition==2) {
			renderY=y-25;
			renderX=x-100;
		} else if (currentPosition==3) {
			renderY=y-25;
			renderX=x-17;
		} else {
			renderY=y-20;
			renderX=x-100;
		}
	} else {
		renderX=x-5;
		renderY=y-5;
	}
	shoe[currentShoe].css('top', renderY+'px');
	shoe[currentShoe].css('left', renderX+'px');
}

function nextShoe() {
	updateTextFields();
	if (currentShoe==4) {
		moveTheShoe=false;
	} else {
		currentShoe+=1;
		if (currentShoe==1 || currentShoe==3) { renderCurrentFoot(); }
		shoe[currentShoe].css('display','block');
	}
}

function updateTextFields() {
	if (currentShoe==1) {
		$("#Trick_trick_default_stance").attr("value",currentPosition);
		$("#Trick_trick_popfoot_top").attr("value",currentYCoord);
		$("#Trick_trick_popfoot_left").attr("value",currentXCoord);
	} else if (currentShoe==2) {
		$("#Trick_trick_popfoot_top2").attr("value",currentYCoord);
		$("#Trick_trick_popfoot_left2").attr("value",currentXCoord);
	} else if (currentShoe==3) {
		$("#Trick_trick_frontfoot_top").attr("value",currentYCoord);
		$("#Trick_trick_frontfoot_left").attr("value",currentXCoord);
	} else {
		$("#Trick_trick_frontfoot_top2").attr("value",currentYCoord);
		$("#Trick_trick_frontfoot_left2").attr("value",currentXCoord);
	}
}

function renderCurrentFoot() {
	var foot;
	if (currentShoe==3) {
		foot = "front"+currentPosition;
		shoe[3].attr("class",foot);
	} else if (currentShoe==1) {
		foot = "pop"+currentPosition;
		shoe[1].attr("class",foot);
	}
}

function resetTrick() {
	shoe[1].css('display','block');
	for (i=2;i<=4;i++) shoe[i].css('display','none');
	moveTheShoe=true;
	currentShoe=1;
}
