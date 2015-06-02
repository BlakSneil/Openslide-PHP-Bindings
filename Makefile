all:
	swig -php openslide.i
	clang `php-config --includes` `pkg-config --cflags MagickWand` -fpic -c -I/opt/local/include/openslide -w openslide_wrap.c
	clang -bundle -bundle_loader /usr/bin/php -dynamic *.o `pkg-config --libs MagickWand` -lopenslide -o openslide.so

install:
	install -C openslide.so /usr/lib/php/extensions/no-debug-non-zts-20121212/openslide.so

clean:
	rm openslide_wrap.*
	rm php_openslide.h