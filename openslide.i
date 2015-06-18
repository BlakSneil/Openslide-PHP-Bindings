%module openslide

/* includes and functions for types and pointers and arrays */
%include "stdint.i"
%include "cpointer.i"
%pointer_functions(int, int_p)
%pointer_functions(int32_t, int32_t_p)
%pointer_functions(int64_t, int64_t_p)
%pointer_functions(uint32_t, uint32_t_p)


/* Following two lines are for bypassing some defines of openslide that cause compiling errors */
#define OPENSLIDE_PUBLIC()
#define OPENSLIDE_DEPRECATED_FOR(...)

/* Imports this header without generating wrappers for its functions */
%include "/opt/local/include/openslide/openslide.h"

%{
	/* Includes the header in the wrapper code */
	#include "/opt/local/include/openslide/openslide.h"

	/* Following two lines are to avoid unimplemented methods errors */
	int _openslide_give_prefetch_hint_UNIMPLEMENTED() {}
	void _openslide_cancel_prefetch_hint_UNIMPLEMENTED() {}

	#include <wand/magick_wand.h>

	int write_jpg(openslide_t *osr, char *filePath, int64_t x, int64_t y, int32_t level, int64_t w, int64_t h, int64_t tile_w, int64_t tile_h) {

		uint32_t *buffer = (uint32_t *)malloc(w * h * 4);

		openslide_read_region(osr, buffer, x, y, level, w, h);

		MagickWand *m_wand = NewMagickWand();

	    MagickConstituteImage(m_wand, w, h,"RGBA", CharPixel, buffer);
		
		MagickWandGenesis();
		
		MagickResizeImage(m_wand, tile_w, tile_h, LanczosFilter, 1);
		
		MagickSetImageCompressionQuality(m_wand, 95);
		
		MagickWriteImage(m_wand, filePath);
		
		if (m_wand) m_wand = DestroyMagickWand(m_wand);
		
		MagickWandTerminus();

		return 0;
	}
%}

int write_jpg(openslide_t *osr, char *filePath, int64_t x, int64_t y, int32_t level, int64_t w, int64_t h, int64_t tile_w, int64_t tile_h);