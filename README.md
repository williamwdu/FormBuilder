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
height $b and binary $c indicate either the cell is fill all the way to the right or specify width

# function h1($a,$b=10,$c=12)
largest header, center text $a into a box
$b is the height of box, default to 10 
$c is the font size, defalut is 12

# function h2($a,$b=5,$c=11)
secondary header, center text $a into a box
$b is the height of box, default to 5 
$c is the font size, defalut is 11