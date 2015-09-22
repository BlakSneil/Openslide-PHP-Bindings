# Openslide-PHP-Bindings
PHP Bindings and other stuff for the [Openslide](http://openslide.org/) C Library.

This software has been designed and developed as Master Thesis in Computer Science under the supervision of prof. V. Della Mea, University of Udine, Italy, inside the Marie Curie AIDPATH Project (http://www.aidpath.eu).

_The implementation (and much more the documentation) is at early stages and will be completed soon._

This work uses [SWIG](http://www.swig.org/) and [MagickWand](http://www.imagemagick.org/script/magick-wand.php) to generate PHP bindings for [Openslide](http://openslide.org/) in the form of a PHP .so module. See the makefile to learn how the module is generated. 

The module contains also a function **write_jpg** that extracts a region from the slide and converts it in jpeg.

As programming example, there is a function **createDeepZoomTile** that receives in input a DeepZoom request and creates a correct jpeg tile for the slide.

The code was tested under OS X Yosemite with PHP 5.5.20. I installed all three libraries through [Homebrew](http://brew.sh/).

Many thanks to _Gigabytes_ for his help.

FURTHER WORK
- generic makefile for a more interoperable installation
- reducing dependencies from modules not already used by OpenSlide


