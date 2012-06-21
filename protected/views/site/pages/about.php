<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);?>
<h1>The idea</h1>

<p>The idea of this online game is to be a simple online version of the classical Game of Skate (which is also known as horse). As the majority of computer games tends to create a virtual world of any kind where you can be anywho you want (if you spend enough time in game or whatever), we just want to reflect the reality, so in this game, every player <strong>have to validate his/her own skateboarding tricks</strong> with videos with him/her to be able to do them in the game.</p>

<h1>Gameplay</h1>
<p>We wanted the gameplay to be as simple as possible, but also a bit competitive and realistic and avoid huge system requirements, so anyone can play it - whatever your OS or computer hardware is. The result is this: </p>
<img src="/horse/images/gameplay.png" alt="gameplay explained" align="center" />

<h1>The interface explained</h1>
<p>To play the game is very simple but first of all, you have to know how the gameplay interface is thought. I will try to explain the interface, side by side.</p>
<hr/>
<p><img src="/horse/images/players.png" alt="players bar"/><br />This is the players bar. In the screenshot, i was logged in as <strong>demo3</strong>, as you can see my username is bolded in the player bar.<br /><br />Now look at the arrow in front of my name. That means that there was my turn to trick. The arrow appears in front of the user which turn to trick is at that moment.<br/><br/>Did you notice that he background color of my name is green? That's because the other user failed the trick when was his turn or I am opening the game. In both cases, just the user with green background can do any trick he wants (and can) and if the other player fails doing the same trick, he gets a letter, just like in the real-life Game of Skate. <em><strong>Note:</strong> Be careful when the other player has a green background; if you fail, you get a letter.</em></p>
<hr/>
<p><img src="/horse/images/trickbar.png" alt="trick bar"/><br />This is the current trick bar. If it is filled with a trick name and it's your turn, your opponent has a green background and, if you fail doing the trick specified (in the stance specified), you get a letter. At five letters (SKATE), you lose the game and the opponent wins (6-OPPONENT_LETTERS) points. (eg. if you lose and your opponent has 3 letters, he wins 6-3=3 points)</p>
<hr />
<p><img src="/horse/images/feetScreen.png" alt="feet screen"/><br />This is where you place your feet on the skateboard and select the direction each feet moves in (almost) the real-life skateboarding.<br /><br/>
<strong>STEP 1</strong>: move the mouse around the skateboard and place the POP FOOT with one click <strong>but do NOT release the mouse button</strong>.<br/>
<strong>STEP 2</strong>: move the mouse around the game screen and place the blue square where you want your foot to move in real-life skateboarding and then release the mouse button to fix it.<br/>
<strong>STEP 3</strong>: move the mouse around the skateboard and place the FRONT FOOT with one click, and HOLD THE BUTTON.<br/>
<strong>STEP 4</strong>: move the mouse around the game screen and place the red square where you want your feet to move with releasing the click button.</p>

<strong>toggle the SWITCH MODE with the right mouse button or by pressing the mouse wheel.</strong> Switch mode allows you to trick in switch and nollie positions (and normal mode in normal and fakie).
