# ClickCounter
ClickCounter is a PHP class that allows you to control the number of visitors who clicked on certain links. Useful for statistics on navigation and \ or downloading files.

# How use it
To use the class will need, call the static method getHref class CCounter, passing as the only argument the link
Example:
```html<a href="<?php print_r($CC::getHref('link1.html')); ?>" target="_blank">Link1</a><br/>[/code]```

If the link is unreachable, the class will direct the browser to the 404 page indicated in configurations. 
