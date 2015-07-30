# Lumen image
Lumen Image is an image manipulation package for Lumen framework adapted from [Folklore - Laravel image](https://github.com/Folkloreatelier/laravel-image) and based on the [PHP Imagine library](https://github.com/avalanche123/Imagine). It is inspired by [Croppa](https://github.com/BKWLD/croppa) as it can use specially formatted urls to do the manipulations. It supports basic image manipulations such as resize, crop, rotation and flip. It also supports effects such as negative, grayscale, gamma, colorize and blur. You can also define custom filters for greater flexibility.

### Credits:

This package is an adaptation of image manipulation library created by [Folklore - Laravel image](https://github.com/Folkloreatelier/laravel-image) for lumen framework.
--

The main difference between this package and other image manipulation libraries is that you can use parameters directly in the url to manipulate the image. A manipulated version of the image is then saved in the same path as the original image, **creating a static version of the file and bypassing PHP for all future requests**.

For example, if you have an image at this URL:

    /uploads/photo.jpg

To create a 300x300 version of this image in black and white, you use the URL:

    /uploads/photo-image(300x300-crop-grayscale).jpg
    
To help you generate the URL to an image, you can use the `Image::url()` method

```php
Image::url('/uploads/photo.jpg',300,300,array('crop','grayscale'));
```

or

```html
<img src="<?=Image::url('/uploads/photo.jpg',300,300,array('crop','grayscale'))?>" />
```

Alternatively, you can programmatically manipulate images using the `Image::make()` method. It supports all the same options as the `Image::url()` method.

```php
Image::make('uploads/photo.jpg',array(
	'width' => 300,
	'height' => 300,
	'grayscale' => true
))->save('path/to/the/thumbnail.jpg');
```

or use directly the Imagine library

```php
$thumbnail = Image::open('uploads/photo.jpg')
			->thumbnail(new Imagine\Image\Box(300,300));

$thumbnail->effects()->grayscale();
	
$thumbnail->save('path/to/the/thumbnail.jpg');
```

## Features

This package use [Imagine](https://github.com/avalanche123/Imagine) for image manipulation. Imagine is compatible with GD2, Imagick, Gmagick and supports a lot of [features](http://imagine.readthedocs.org/en/latest/).

This package also provides some common filters ready to use ([more on this](https://github.com/Folkloreatelier/laravel-image/wiki/Image-filters)):
- Resize
- Crop (with position)
- Rotation
- Black and white
- Invert
- Gamma
- Blur
- Colorization

## Installation
#### Dependencies:

* [Lumen 5.x](https://github.com/laravel/lumen)
* [Imagine 0.6.x](https://github.com/avalanche123/Imagine)

#### Server Requirements:

* [gd](http://php.net/manual/en/book.image.php) or [Imagick](http://php.net/manual/fr/book.imagick.php) or [Gmagick](http://www.php.net/manual/fr/book.gmagick.php)
* [exif](http://php.net/manual/en/book.exif.php) - Required to get image format.

#### Installation:

```
composer require ktquez/lumen-image
```

##### configuration:

Inside the file ``bootstrap/app.php`` and insert the following lines

```
$app->configure('image');

$app->register('Folklore\Image\ImageServiceProvider');

class_alias('Folklore\Image\Facades\Image','Image');
```

## Documentation
* [Complete documentation](https://github.com/Folkloreatelier/image/wiki)
* [Configuration options](https://github.com/Folkloreatelier/image/wiki/Configuration-options)
