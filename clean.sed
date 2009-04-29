#! /usr/bin/sed

# techcrunch.com - remove headlines and adverts
/<div id="header_features"/d
/Advertisement<br/,/<div style="clear: both"><\/div>/d
/<div class="alignleft/,$d

