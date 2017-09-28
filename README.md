# About this project
This project is extended from fpdf to help fast buding forms, invoice, etc.
This project provide fast and consistent layout to the final product.

# How to use this project
Download the code, and include it after fpdf.php

# Default Variable
All configuration is based on US Letter Size Paper.
Support for A4 will be added soon.

# Leftcol($a,$b=10,$c=35)
Add text $a to the left corner of the column with bold font: height $b and width $c

# Textcol($a,$b=10,$c=1)
Add text $a to the left corner of the column with Times font
height $b
binary $c indicate either the cell is fill all the way to the right or specify width
if $c=1, an new line will be called.

# function h1($a,$b=10,$c=12)
largest header, center text $a into a box
$b is the height of box, default to 10 
$c is the font size, defalut is 12

# function h2($a,$b=5,$c=11)
secondary header, center text $a into a box
$b is the height of box, default to 5 
$c is the font size, defalut is 11

# function textline($a,$b=5,$c=8)
regular text by line
default, Arial 8 regular

# function custompagenumber($a=25)
Add pagenumber to right upper corner of the page, $a is the distance of page number to the upper edge of the page

# function customheader($logo,$title,$y_axis_initial=10)
Add a title to the page, including a line, a log and a title.
$logo is the path of the image

# function box($a,$b=5)
Draw a whole page box for some section before
Waring: Use this after you create all the text.
It will draw a box that include $a rows from your current pin position

# function checkbox($x,$y,$item,$checked=0,$a=5)
Create a checkbox with text $item followed by it. If $checked=1, an X will be checked in checkbox