Real life Game of S.K.A.T.E.
============================

- Can be played in 2 or more.
- The first skater (player, skateboarder) does a trick
- - If he succeeds, the next one has to do the same or he gets a letter (for first, S)
- - If he fails, the next one does a trick.
- This repeats until only one player is left in the game.

My online version of it
=======================

Can be played only in 2 *randomly* chosen players. The concept of playing is the same.

To do a trick in this game you need to point the shoes of a skater on a skateboard deck using your mouse, like this:

- when you move the mouse around the deck, there is the back foot following the mouse.
- when you click (but do not release the mouse button) you place that foot
- holding the click you need to place a point which represents the movement direction of that foot when a real skateboarder does the trick you want to do
- release the mouse button to place that dot
- repeat that steps to place the front foot

This way doing tricks comes very natural for people practicing skateboarding.


Storing the tricks
==================
We actually store the coordinates of both feet and the directions and distances of movement.
When trying to do a trick there is an offset allowed, saved as a constant in protected/models/trick.php


INSTALLATION
============

Requirements
------------
- PHP5
- apache2
- mysql, php5-mysql
- ffmpeg, ffmpeg-php
- YiiFramework (last tested on 1.1.10) http://yiiframework.com

Installation
------------

1. Copy all the files in a web-accesible folder. (*)
2. Make sure it displays a home page with no actual working features (no database yet) -- actually, make sure the files can require YiiFramework successfully
3. Import horse.sql in a MySQL database and configure it in protected/config/main.php
4. The first user you create will have admin role :)


(*) You can configure the application to keep protected/* files into a non-web-readable folder, which is good practice but the current structure is the default of Yii and  more convenient for development.


Final Note
==========

This is my *first* (after playing with it a bit...) project made with YiiFramework and I did not follow best practices or good organisation of code.
The project was presented at ITFest 2010 Bucharest, gaming section and placed 1st.


MIT LICENCE
===========

Copyright (C) 2010 Vlad Velici

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE

IN-GAME IMAGES
==============

The images used for the game are just findings on the Internet - I do not have any rights on them - If you want to use this game for any reason I think it is better to replace them with your own images.

