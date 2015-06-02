#include <wand/magick_wand.h>
#include <openslide.h>

int write_jpg(openslide_t *osr, char *filePath, int64_t x, int64_t y, int32_t level, int64_t w, int64_t h, int64_t tile_w, int64_t tile_h) {

	uint32_t *buffer = (uint32_t *)malloc(w * h * 4);

	openslide_read_region(osr, buffer, x, y, level, w, h);

	MagickWand *m_wand = NewMagickWand();

    MagickConstituteImage(m_wand, w, h,"RGBA", CharPixel, buffer);
	
	MagickWandGenesis();
	
	// Resize the image using the Lanczos filter
	// The blur factor is a "double", where > 1 is blurry, < 1 is sharp
	// I haven't figured out how you would change the blur parameter of MagickResizeImage
	// on the command line so I have set it to its default of one.
	MagickResizeImage(m_wand, tile_w, tile_h, LanczosFilter, 1);
	
	// Set the compression quality to 95 (high quality = low compression)
	MagickSetImageCompressionQuality(m_wand, 95);
	
	/* Write the new image */
	MagickWriteImage(m_wand, filePath);
	
	/* Clean up */
	if (m_wand) m_wand = DestroyMagickWand(m_wand);
	
	MagickWandTerminus();

	return 0;
}