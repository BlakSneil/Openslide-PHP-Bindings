%module openslide

/* includes and functions for types and pointers */
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

%include "write_jpeg.c"

%{
	/* Includes the header in the wrapper code */
	#include "/opt/local/include/openslide/openslide.h"

	/* Following two lines are to avoid unimplemented methods errors */
	int _openslide_give_prefetch_hint_UNIMPLEMENTED() {}
	void _openslide_cancel_prefetch_hint_UNIMPLEMENTED() {}

	#include <wand/magick_wand.h>

	#include "write_jpeg.c"
%}
