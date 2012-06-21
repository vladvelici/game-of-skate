var currentXCoord=0;
var currentYCoord=0;

var containerDiv = "#inputSkateTrick";
var container = $(containerDiv);
var $status = $('#status');

container.bind("contextmenu",function(e){ return false; });

var xMax=parseInt(container.css('width'));
var yMax=parseInt(container.css('height'));

var yPositionChange = Math.round(yMax/2);

var pop_x1,pop_x2,pop_y1,pop_y2;
var front_x1,front_x2,front_y1,front_y2;

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

var currentShoe=1;
var moveTheShoe=false;
var currentPosition=1;
var sw=false;


container.mousemove(function(e){
	if (!moveTheShoe) return false;
	if (moveTheShoe) {
		currentXCoord = e.pageX - this.offsetLeft;
		currentYCoord = e.pageY - this.offsetTop;
		moveShoe(currentXCoord,currentYCoord);
	}
});

container.mousedown(function(e) {
	if (!moveTheShoe) return false;
	if (e.which==1) {
		nextShoe();
	} else {
		toggleSw();
	}
});

container.mouseup(function(e){
	if (!moveTheShoe) return false;
	if (e.which==1) {
		nextShoe();
	}
});



function toggleSw() {
	if (!moveTheShoe) return false;
	if (sw) {
		sw=false;
	} else {
		sw=true;
	}
	moveShoe(currentXCoord,currentYCoord);
}

function moveShoe(x,y) {
	if (!moveTheShoe) return false;
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
	if (renderX>0 && renderX+118<xMax) shoe[currentShoe].css('left', renderX+'px');
	if (renderY>0 && renderY+56<yMax) shoe[currentShoe].css('top', renderY+'px');

}

function nextShoe() {
	updateTextFields();
	if (currentShoe==4) {
		moveTheShoe=false;
		sendTrick();
	} else {
		currentShoe+=1;
		if (currentShoe==1 || currentShoe==3) { renderCurrentFoot(); }
		shoe[currentShoe].css('display','block');
	}
}

function updateTextFields() {
	if (currentShoe==1) {
		pop_y1=currentYCoord;
		pop_x1=currentXCoord;
	} else if (currentShoe==2) {
		pop_y2=currentYCoord;
		pop_x2=currentXCoord;
	} else if (currentShoe==3) {
		front_y1=currentYCoord;
		front_x1=currentXCoord;
	} else {
		front_y2=currentYCoord;
		front_x2=currentXCoord;
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

function sendTrick() {
	$("#wait").css('display','block');
	$("#wait").html('sending trick...');
	var feet_coords="pop_x1="+pop_x1+
	"&pop_x2="+pop_x2+
	"&pop_y1="+pop_y1+
	"&pop_y2="+pop_y2+
	"&front_x1="+front_x1+
	"&front_x2="+front_x2+
	"&front_y1="+front_y1+
	"&front_y2="+front_y2+
	"&pos="+currentPosition;
	$.ajax({
		type:"POST",
		url:"/horse/index.php?r=gameAjax/sendTrick&id="+gameId,
		data: feet_coords,
		async: false,
		success: function(data) {
			if (data=="false") {
				alert("error");
			}
			data=data.split(';')
			$('#wait').html('trick sent:<br/>'+positions[data[5]]+' '+data[4]);
			updateAndRender(data);
		},
		fail: function(xml,err) {
		}
	});
}
var gameStatus=false;
var opponentName=false;
var player1Letters=0;
var player2Letters=0;
var currentTrick=false;
var currentTrickPosition=false;
var currentPlayer=false;

function renderLetters(obj,no) {
	var letter=[1];
	letter[1]="s";
	letter[2]="k";
	letter[3]="a";
	letter[4]="t";
	letter[5]="e";
	obj.html("");
	for (i=1;i<=no;i++) {
		obj.html(obj.html()+letter[i]);
	}
}

function updateAndRender(data) {
	//0 - game status
	//1 - opponent name
	//2 - player1 letters
	//3 - player2 letters
	//4 - current trick
	//5 - current trick position
	//6 - current player
 	//optional 7 - debug info

	if (data[0]==0) {
		$('#wait').css('display','block');
		$('#wait').html("waiting for someone to join");
	} else if (data[0]==1) {
		if (opponentName===false) {
			opponentName=data[1];
			$('#wait').css("display","none");
			$('#player'+(3-youAre)+' .pName').html(opponentName);
		}
		if (player1Letters!==data[2]) {
			player1Letters=data[2];
			renderLetters($('#player1 .score'),player1Letters);
		}
		if (player2Letters!==data[3]) {
			player2Letters=data[3];
			renderLetters($('#player2 .score'),player2Letters);
		}
		if (currentTrick!==data[4] || currentTrickPosition!==data[5] || currentPlayer!==data[6]) {
			currentTrick = data[4];
			currentTrickPosition=data[5];
			if (currentTrick!=0) {
				$("#currentTrick").html(positions[currentTrickPosition]+" "+currentTrick);
			} else {
				$("#currentTrick").html('chose trick');
			}
			currentPlayer=data[6];
			if (currentPlayer==youAre) {
				resetTrick();
				$('#wait').css("display","none");
			} else {
				$('#wait').html(opponentName+'\'s turn');
				$('#wait').css('display','block');
			}

			$('#player'+currentPlayer+' .toTrick').css("visibility","visible");
			$('#player'+(3-currentPlayer)+' .toTrick').css("visibility","hidden");

			if (currentTrick==0) {
				$('#player'+currentPlayer).addClass("lead");
				$('#player'+(3-currentPlayer)).removeClass("lead");
			} else {
				$('#player'+currentPlayer).removeClass("lead");
				$('#player'+(3-currentPlayer)).addClass("lead");
			}

		}

		if (data[7])
			console.log(data[7])

	} else if (data[0]==2) {
		listen=false;
		$('#wait').css('display','block');
		if (youAre==1) {
			msg="you won!";
		} else {
			msg="you lost!";
		}
		$('#wait').html(msg);
	} else if (data[0]==3) {
		listen=false;
		$('#wait').css('display','block');
		if (youAre==2) {
			msg="you won!";
		} else {
			msg="you lost!";
		}
		$('#wait').html(msg);
	} else if (data[0]==4) {
		listen=false;
		$('#wait').css('display','block');
		$('#wait').html("Connection problem! We're sorry.");
	}
}
listen=true;
function listener() {
	$.ajax({
		type:"get",
		url:"/horse/index.php?r=gameAjax/status&id="+gameId,
		success:function(data) {
			updateAndRender(data.split(';'));
			if (listen) {
			var t=setTimeout('listener();',2000);
			}
		}
	});

}

listener();
