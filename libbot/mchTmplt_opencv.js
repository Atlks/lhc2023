
// opencv cant install..look alsos need invk python lib

var cv = require('opencv');

cv.readImage('./Template_Matching_Original_Image.jpg', function(err, im) {
    if (err) return console.error('error loading image');

    var output = im.matchTemplate('./Template_Matching_Template_Image.jpg', 3);

    var matches = output.templateMatches(0.80, 1.0, 5, false);

    console.log(matches);
});
