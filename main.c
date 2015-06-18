#include <openslide.h>
#include "read_tile.c"

int main() {
	char *osrPath = "test1.svs";
	char *jpgPath = "tile1.jpg";

	int64_t x = 1000;
	int64_t y = 1000;
	int32_t level = 2;
	int64_t	w = 1000;
	int64_t h = 1000;
	int64_t tile_w = 256;
	int64_t tile_h = 256;

	openslide_t *osr = openslide_open(osrPath);

	if (osr == NULL) {
		printf("File is not supported\n");
		return 1;
	} else if (openslide_get_error(osr)) {
		printf("Failed to open slide: %s\n", openslide_get_error(osr));
		openslide_close(osr);
		return 2;
	}

	unsigned char *tile = read_tile(osr, x, y, level, w, h, tile_w, tile_h);

	printf("%s\n", tile);

	openslide_close(osr);
}